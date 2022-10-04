<?php

namespace App\Imports;

use App\Enums\General\HighSchoolRole;
use App\Enums\User\Role;
use App\Enums\User\Status;
use App\Helpers;
use App\Models\HighSchool;
use App\Models\Joins\UserHighSchools;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HighSchools
{
    public static function importFromGoogle($db)
    {
        $schools = DB::connection($db)->select('
            select * from counselors_table where imported = 0;
        ');

        foreach ($schools as $school) {
            self::importItem($school);
            self::markImported($school, $db);
        }

        $schools = DB::select('
            select student_id, text, s.user_id
            from meto_answers
            join meto_students as s on student_id = s.id
            where question_id = 118;
        ');
        foreach ($schools as $school) {
            self::importStudent($school);
        }
    }

    public static function importItem(\stdClass $school)
    {
        $hs = new HighSchool();
        $hs->name = $school->high_school;
        $hs->save();

        $user = new User();
        $user->email = $school->counselor_email;
        $user->role = Role::COUNSELOR();
        $user->status = Status::ACTIVE();
        $user->save();

        UserHighSchools::joinUserHighSchool($user->id, $hs->id, HighSchoolRole::COUNSELOR);
    }

    public static function importStudent(\stdClass $student) :void
    {
        // create new HS record, new student, new join
        $existing = HighSchool::where('name', $student->text);
        if ($existing->count() > 0) {
            UserHighSchools::joinUserHighSchool($student->user_id, $existing->first()->id, HighSchoolRole::STUDENT);
        } else {
            $new = new HighSchool();
            $new->name = $student->text;
            $new->save();

            UserHighSchools::joinUserHighSchool($student->user_id, $new->id, HighSchoolRole::STUDENT);
        }
    }

    public static function markImported(\stdClass $school, $db)
    {
        DB::connection($db)->update('
            update counselors_table set imported = 1 where high_school = "' . $school->high_school . '";
        ');
    }
}
