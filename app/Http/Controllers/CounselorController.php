<?php

namespace App\Http\Controllers;

use App\Enums\General\Month;
use App\Enums\HighSchool\ClassSize;
use App\Enums\HighSchool\Cost;
use App\Enums\HighSchool\Exam;
use App\Enums\HighSchool\SchoolSize;
use App\Enums\HighSchool\Type;
use App\Enums\Student\Curriculum;
use App\Models\EnumCountry;
use App\Models\HighSchool;
use App\Models\Joins\UserHighSchool;
use App\Models\StudentUniversity;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        // TODO: rows are students, columns are statuses, cells are counts
        $data = StudentUniversity::getMatchesByHighSchool($highscool_id);
        return view('counselor.matches', [
            'data' => $data,
            'notes' => UserHighSchool::getNotes(Auth()->user()->id),
        ]);
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

    }
}
