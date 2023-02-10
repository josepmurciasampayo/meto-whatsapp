<?php

namespace App\Imports;

use App\Enums\HighSchool\Role as HighSchoolRole;
use App\Enums\HighSchool\Type;
use App\Enums\User\Role;
use App\Enums\User\Status;
use App\Helpers;
use App\Models\HighSchool;
use App\Models\Joins\UserHighSchool;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentHighSchools
{
    public static function importFromGoogle()
    {
        $students = DB::select('
            select student_id, question_id, text, s.user_id
            from meto_answers as a
            join meto_students as s on student_id = s.id
            where question_id in (118, 119, 164);
        ');
        foreach ($students as $student) {
            self::importStudent($student);
        }
        Log::channel('import')->info('Imported ' . count($students) . ' new student/high school relationships');
    }

    public static function importStudent(\stdClass $student) :void
    {
        // create new HS record, new student, new join
        $existing = HighSchool::where('name', $student->text);
        if ($existing->count() > 0) {
            UserHighSchool::joinUserHighSchool($student->user_id, $existing->first()->id, HighSchoolRole::STUDENT);
        } else {
            $new = new HighSchool();
            if ($student->question_id == 164) {
                $new->type = Type::ACCESS();
            }
            $new->name = $student->text;
            $new->save();

            UserHighSchool::joinUserHighSchool($student->user_id, $new->id, HighSchoolRole::STUDENT);
        }
    }

}
