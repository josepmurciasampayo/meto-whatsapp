<?php

namespace App\Http\Controllers;

use App\Enums\Country\Country;
use App\Enums\HighSchool\Size;
use App\Enums\HighSchool\Type;
use App\Enums\Student\Curriculum;
use App\Models\EnumCountry;
use App\Models\HighSchool;
use App\Models\StudentUniversity;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CounselorController extends Controller
{
    public function highschool(int $id) :View
    {
        $data = HighSchool::getAdminData($id);
        $countries = EnumCountry::getArray();
        $curricula = Curriculum::descriptions();
        $types = Type::descriptions();
        $sizes = Size::descriptions();

        return view('counselor.highschool', [
            'school' => $data,
            'countries' => $countries,
            'curricula' => $curricula,
            'types' => $types,
            'sizes' => $sizes,
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
        $highschool->size = $request->size;

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
        return view('counselor.students', ['data' => $data]);
    }

    public function matches(int $highscool_id) :View
    {
        $data = StudentUniversity::getMatchesByHighSchool($highscool_id);
        return view('counselor.matches', ['data' => $data]);
    }
}
