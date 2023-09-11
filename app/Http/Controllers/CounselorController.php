<?php

namespace App\Http\Controllers;

use App\Enums\EnumGroup;
use App\Enums\General\ConnectionStatus;
use App\Enums\General\Month;
use App\Enums\HighSchool\Boarding;
use App\Enums\HighSchool\ClassSize;
use App\Enums\HighSchool\Cost;
use App\Enums\HighSchool\Exam;
use App\Enums\HighSchool\SchoolSize;
use App\Enums\HighSchool\Type;
use App\Enums\Student\Curriculum;
use App\Enums\User\Role;
use App\Enums\User\Status;
use App\Helpers;
use App\Imports\StudentHighSchools;
use App\Mail\InviteCounselor;
use App\Mail\SendConnectionRequestToAdmin as SendConnectionRequestToAdminMail;
use App\Models\EnumCountry;
use App\Models\HighSchool;
use App\Models\Joins\UserHighSchool;
use App\Models\Question;
use App\Models\Connection;
use App\Models\Student;
use App\Models\User;
use App\Services\StudentService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class CounselorController extends Controller
{
    public function highschool(int $highschool_id) :View
    {
        $school = HighSchool::find($highschool_id);
        if ($school) {
            return view('counselor.highschool', [
                'school' => $school,
                'countries' => EnumCountry::getArray(),
                'curricula' => Curriculum::getSchoolChoices(),
                'types' => Type::descriptions(),
                'classSizes' => ClassSize::descriptions(),
                'schoolSizes' => SchoolSize::descriptions(),
                'costs' => Cost::descriptions(),
                'exams' => Exam::descriptions(),
                'months' => Month::descriptions(),
                'boarding' => Boarding::descriptions(),
                'counselors' => User::getCounselorsAtHS($highschool_id),
            ]);
        }
    }

    public function updateHighschool(Request $request) :RedirectResponse
    {
        $highschool = HighSchool::find($request->highschool_id);

        $highschool->name = $request->name;
        $highschool->city = $request->city;
        $highschool->country = $request->country;
        $highschool->curriculum = $request->curriculum;
        $highschool->type = $request->type;
        $highschool->school_size = $request->schoolSize;
        $highschool->class_size = $request->classSize;
        $highschool->url = $request->url;
        $highschool->boarding = $request->boarding;
        $highschool->general_email = $request->email;
        $highschool->government_code = $request->code;
        $highschool->cost = $request->cost;
        $highschool->exam = $request->exam;
        $highschool->finish_month = $request->month;

        $highschool->save();

        return redirect(route('highschool', ['highschool_id' => $request->highschool_id]));
    }

    public function students(int $highschool_id) :View
    {
        $students = UserHighSchool::with('user')->students($highschool_id)->get();
        return view('counselor.students', [
            'students' => $students,
            'notes' => UserHighSchool::getNotes(Auth::user()->id),
        ]);
    }

    public function matches(int $highschool_id) :View
    {
        $data = Helpers::dbQueryArray('
            select
                u.id as "user_id",
                s.id as "student_id",
                concat(u.first, " ", u.last) as "name",
                u.email,
                i.id as "institution_id",
                i.name as "institution_name",
                m.created_at as "date",
                m.status as status_code,
                if(s.active = 1, "Yes", "No") as "active",
                status.enum_desc as "status"
            from meto_students as s
            join meto_users as u on s.user_id = u.id
            join meto_user_high_schools as h on h.user_id = u.id and h.highschool_id = ' . $highschool_id .'
            join meto_connections as m on m.student_id = s.id
            join meto_institutions as i on m.institution_id = i.id
            join meto_high_schools as hs on h.highschool_id = hs.id
            join meto_enum as status on status.enum_id = m.status and status.group_id = ' . EnumGroup::GENERAL_MATCH() . ';
        ');
        $summary = self::makeSummaryMatchData($data);
        return view('counselor.matches', [
            'data' => $data,
            'summary' => $summary,
            'notes' => UserHighSchool::getNotes(Auth()->user()->id),
        ]);
    }

    public static function makeSummaryMatchData(array $data) :array
    {
        // name, active, unknown, not interested, applied, accepted, denied, enrolled, waitlisted
        $toReturn = [];
        $statusArray = [ // empty row to add for each student
            'name' => '',
            'active' => '',
            'student_id' => '',
            'user_id' => '',
            ConnectionStatus::UNKNOWN() => 0,
            ConnectionStatus::MATCHED() => 0,
            ConnectionStatus::NOTINTERESTED() => 0,
            ConnectionStatus::APPLIED() => 0,
            ConnectionStatus::ACCEPTED() => 0,
            ConnectionStatus::DENIED() => 0,
            ConnectionStatus::ENROLLED() => 0,
            ConnectionStatus::WAITLISTED() => 0,
        ];
        foreach ($data as $row) {
            // inititialize $toReturn with 0's in every spot
            $student = $row['student_id'];
            if (isset($toReturn[$student])) {
                continue;
            } else {
                $toReturn[$student] = $statusArray;
            }
        }

        foreach ($data as $row) { // now go through and store the relevant data in the structure
            $student_id = $row['student_id'];
            $status = $row['status_code'];
            $toReturn[$student_id]['name'] = $row['name'];
            $toReturn[$student_id]['active'] = $row['active'];
            $toReturn[$student_id]['student_id'] = $row['student_id'];
            $toReturn[$student_id]['user_id'] = $row['user_id'];
            $toReturn[$student_id][$status]++;
        }

        return $toReturn;
    }

    public function student(int $student_id) :View
    {
        $data = Helpers::dbQueryArray('
            select
                concat (u.first, " ", u.last) as "name",
                u.id as "user_id",
                s.id as "student_id",
                q.text as "question",
                q.id as "question_id",
                a.text as "answer",
                s.verify,
                s.verify_notes
            from meto_students as s
            join meto_users as u on s.user_id = u.id
            join meto_answers as a on a.student_id = s.id
            join meto_questions as q on q.id = a.question_id
            where student_id = ' . $student_id . '
            order by type, question_id;
        ');
        $matches = Connection::getByUserID(Student::find($student_id)->user_id);
        $notes = UserHighSchool::getNotes(Auth()->user()->id);
        return view('counselor.student', [
            'data' => $data,
            'matches' => $matches,
            'notes' => $notes,
            'matchStatuses' => ConnectionStatus::getCounselorChoices(),
            'student_id' => $student_id,
        ]);
    }

    public function saveMatches(Request $request) :RedirectResponse
    {
        $requestArray = $request->toArray();
        $student_id = $requestArray['student_id'];
        foreach ($requestArray as $index => $value) {
            if ($index == "_token" || $index == 'student_id') {
                continue;
            }
            $id = ((int) substr($index, strpos($index,'-') + 1));
            Connection::updateMatchStatusByMatchID($id, $value);
        }

        return redirect(route('counselor-student', ['student_id' => $student_id]));
    }

    public function saveNotes(Request $request) :RedirectResponse
    {
        $user_id =  Auth()->user()->id;
        $userHighschool = UserHighSchool::where('user_id', $user_id)->first();
        $userHighschool->notes = $request->notes;
        $userHighschool->save();

        return redirect($request->headers->get('referer'));
    }

    public function saveVerify(Request $request) :RedirectResponse
    {
        $student = Student::find($request->student_id);
        $student->verify_notes = $request->verify_notes;
        $student->verify = ($request->verify == "on") ? 1 : 0;
        $student->save();
        return redirect(route('counselor-student', ['student_id' => $request->student_id]));
    }

    public function invite(int $highschool_id, int $user_id = null) :View
    {
        if ($user_id) {
            $join = UserHighSchool::where('user_id', $user_id)->where('highschool_id', $highschool_id)->first();

            return view('counselor.invite', [
                'highschool_id' => $highschool_id,
                'user_id' => $user_id,
                'role' => $join->role,
                'user' => User::find($join->user_id),
                'isInvite' => false,
            ]);
        } else {
            return view('counselor.invite', [
                'highschool_id' => $highschool_id,
                'user_id' => '',
                'role' => \App\Enums\HighSchool\Role::COUNSELOR(),
                'isInvite' => true,
            ]);
        }
    }

    public function sendInvite(Request $request) :RedirectResponse
    {
        if ($request->user_id) {
            $user = User::find($request->user_id);
            $user->first = $request->first;
            $user->last = $request->last;
            $user->email = $request->email;
            $user->title = $request->title;
            $user->save();

            $role = \App\Enums\HighSchool\Role::from($request->role);
            UserHighSchool::updateRole($request->user_id, $role);

            return redirect(route('invite', [
                'highschool_id' => $request->highschool_id,
                'user_id' => $user->id,
            ]));
        } else {
            $currentUser = Auth()->user();

            $user = new User();
            $user->first = $request->first;
            $user->last = $request->last;
            $user->email = $request->email;
            $user->title = $request->title;
            if ($currentUser->isAdmin()) {
                $user->role = $request->role;
            }
            $user->role = Role::COUNSELOR();
            $user->status = Status::ACTIVE();
            $user->password = bcrypt("afow84hfao8w3hflaow8u3ro8afh8a3f");
            $user->save();

            $join = new UserHighSchool();
            $join->user_id = $user->id;
            $join->highschool_id = $request->highschool_id;
            $join->role = \App\Enums\HighSchool\Role::COUNSELOR();
            $join->save();

            Mail::to($user)->cc($currentUser)->send(new InviteCounselor($user, $currentUser, HighSchool::find($request->highschool_id)));
            Log::channel('email')->info($currentUser->first . ' sent counselor invite to ' . $user->first);

            return redirect(route('home'));
        }
    }

    public function fetchStudent(Request $request, Student $student)
    {
        $student->age = Carbon::parse($student->dob)->diffInYears();
        $questionIds = [119, 164, 102, 104, 281, 271, 275, 120, 63, 2, 69, 72, 67, 73, 70, 14, 267, 257, 99, 114, 292, 285, 308];
        $answers = \App\Models\Answer::where('student_id', $student->id)->whereIn('question_id', $questionIds)->get();

        foreach ($answers as $answer) {
            $question = Question::find($answer->question_id);
            $answer->question = $question;
        }

        return response([
            'student' => $student,
            'user' => User::find($student->user_id),
            'qas' => $answers
        ]);
    }

    public function remove(int $student_id) :RedirectResponse
    {
        $highschool_id = HighSchool::getByCounselorID(Auth()->user()->id)->id;
        UserHighSchool::remove($student_id, $highschool_id);
        return redirect(route('counselor-students', ['highschool_id' => $highschool_id]));
    }
}
