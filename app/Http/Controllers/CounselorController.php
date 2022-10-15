<?php

namespace App\Http\Controllers;

use App\Enums\General\MatchStudentInstitution;
use App\Enums\General\Month;
use App\Enums\HighSchool\ClassSize;
use App\Enums\HighSchool\Cost;
use App\Enums\HighSchool\Exam;
use App\Enums\HighSchool\SchoolSize;
use App\Enums\HighSchool\Type;
use App\Enums\Student\Curriculum;
use App\Enums\User\Role;
use App\Enums\User\Status;
use App\Mail\InviteCounselor;
use App\Models\EnumCountry;
use App\Models\HighSchool;
use App\Models\Joins\UserHighSchool;
use App\Models\StudentUniversity;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class CounselorController extends Controller
{
    public function home() :View
    {
        $school = HighSchool::getByCounselorID(Auth()->user()->id);
        return view('counselor.home', [
            'school' => $school,
            'summaryCounts' => HighSchool::getSummaryCounts($school->id),
            'notes' => UserHighSchool::getNotes(Auth()->user()->id),
        ]);
    }

    public function highschool(int $school_id) :View
    {
        return view('counselor.highschool', [
            'school' => HighSchool::find($school_id),
            'countries' => EnumCountry::getArray(),
            'curricula' => Curriculum::descriptions(),
            'types' => Type::descriptions(),
            'classSizes' => ClassSize::descriptions(),
            'schoolSizes' => SchoolSize::descriptions(),
            'costs' => Cost::descriptions(),
            'exams' => Exam::descriptions(),
            'months' => Month::descriptions(),
        ]);
    }

    public function update(Request $request) :RedirectResponse
    {
        $highschool = HighSchool::find($request->id);

        $highschool->name = $request->name;
        $highschool->city = $request->city;
        $highschool->country = $request->country;
        $highschool->curriculum = $request->curriculum;
        $highschool->type = $request->type;
        $highschool->school_size = $request->schooolSize;
        $highschool->class_size = $request->classSize;
        $highschool->url = $request->url;
        $highschool->career_email = $request->career_email;
        $highschool->connection_emails = $request->connection_emails;
        $highschool->government_code = $request->government_code;
        $highschool->cost = $request->cost;
        $highschool->exam = $request->exam;
        $highschool->finish_month = $request->finish_month;

        $highschool->save();

        return redirect(route('highschool', ['id' => $request->id]));
    }

    public function students(int $highscool_id) :View
    {
        $rawData = Student::getStudentsAtSchool($highscool_id);
        $data = "";
        foreach ($rawData as $row) {
            $data .= "[";
            foreach ($row as $value) {
                $data .= "'" . htmlspecialchars($value) . "',";
            }
            $data .= "],";
        }
        return view('counselor.students', [
            'data' => $rawData,
            'notes' => UserHighSchool::getNotes(Auth()->user()->id),
        ]);
    }

    public function matches(int $highscool_id) :View
    {

        $data = StudentUniversity::getMatchesByHighSchool($highscool_id);
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
            MatchStudentInstitution::UNKNOWN() => 0,
            MatchStudentInstitution::NOTINTERESTED() => 0,
            MatchStudentInstitution::APPLIED() => 0,
            MatchStudentInstitution::ACCEPTED() => 0,
            MatchStudentInstitution::DENIED() => 0,
            MatchStudentInstitution::ENROLLED() => 0,
            MatchStudentInstitution::WAITLISTED() => 0,
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
            $student = $row['student_id'];
            $status = $row['status_code'];
            $toReturn[$student]['name'] = $row['name'];
            $toReturn[$student]['active'] = $row['active'];
            $toReturn[$student][$status]++;
        }

        return $toReturn;
    }

    public function student(int $student_id) :View
    {
        $data = Student::getStudentData($student_id);
        return view('counselor.student', [
            'data' => $data,
            'notes' => UserHighSchool::getNotes(Auth()->user()->id),
            ]);
    }

    public function saveNotes(Request $request) :RedirectResponse
    {
        $user_id =  Auth()->user()->id;
        $userHighschool = UserHighSchool::where('user_id', $user_id)->first();
        $userHighschool->notes = $request->notes;
        $userHighschool->save();

        return redirect($request->headers->get('referer'));
    }

    public function invite() :View
    {
        return view('counselor.invite');
    }

    public function sendInvite(Request $request) :RedirectResponse
    {
        $currentUser = Auth()->user();
        $highschool = HighSchool::getByCounselorID($currentUser->id);

        $user = new User();
        $user->first = $request->first;
        $user->last = $request->last;
        $user->email = $request->email;
        $user->title = $request->title;
        $user->role = Role::COUNSELOR();
        $user->status = Status::ACTIVE();
        $user->password = bcrypt("afow84hfao8w3hflaow8u3ro8afh8a3f");
        $user->save();

        $join = new UserHighSchool();
        $join->user_id = $user->id;
        $join->highschool_id = $highschool->id;
        $join->role = \App\Enums\HighSchool\Role::COUNSELOR();
        $join->save();

        Mail::to($user)->cc($currentUser)->send(new InviteCounselor($user, $currentUser));
        Log::channel('email')->info($currentUser->first . ' sent counselor invite to ' . $user->first);

        return redirect(route('home'));
    }
}
