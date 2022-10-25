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

class HighSchools
{
    public static function importFromGoogle($db)
    {
        $schools = DB::connection($db)->select('
            select * from counselors_table where imported = 0;
        ');
        foreach ($schools as $school) {
            if (self::checkDupeSchool($school)) {
                self::markSchoolImported($school, $db);
                continue;
            }
            self::importSchool($school);
            self::markSchoolImported($school, $db);
        }

        $orgs = DB::connection($db)->select('
            select * from additional_student_affiliated_orgs where imported = 0;
        ');
        foreach ($orgs as $org) {
            if (self::checkDupeOrg($org)) {
                self::markOrgImported($org, $db);
                continue;
            }
            self::importOrg($org);
            self::markOrgImported($org, $db);
        }

        $students = DB::select('
            select student_id, question_id, text, s.user_id
            from meto_answers
            join meto_students as s on student_id = s.id
            where question_id in (118, 119, 164);
        ');
        foreach ($students as $student) {
            self::importStudent($student);
        }
    }

    private static function checkDupeSchool(\stdClass $school) :bool
    {
        $existing = DB::select('
            select id from meto_high_schools where name = ' . $school->high_school . ';
        ');
        return count($existing) > 0;
    }

    private static function checkDupeOrg(\stdClass $org) :bool
    {
        $existing = DB::select('
            select id from meto_high_schools where name = ' . $org->organization . ';
        ');
        return count($existing) > 0;
    }

    private static function importSchool(\stdClass $school)
    {
        $hs = new HighSchool();
        $hs->name = $school->high_school;
        $hs->save();

        $user = new User();
        $user->email = $school->counselor_email;
        $user->role = Role::COUNSELOR();
        $user->status = Status::ACTIVE();
        $user->save();

        UserHighSchool::joinUserHighSchool($user->id, $hs->id, \App\Enums\HighSchool\Role::COUNSELOR);
    }

    private static function importOrg(\stdClass $org)
    {
        $hs = new HighSchool();
        $hs->name = $org->organization;
        $hs->type = Type::ACCESS();
        $hs->save();

        $user = new User();
        $user->email = $org->user_email;
        $user->role = Role::COUNSELOR();
        $user->status = Status::ACTIVE();
        $user->save();

        UserHighSchool::joinUserHighSchool($user->id, $org->id, \App\Enums\HighSchool\Role::ADMIN);
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

    private static function markSchoolImported(\stdClass $school, $db)
    {
        DB::connection($db)->update('
            update counselors_table set imported = 1 where high_school = "' . $school->high_school . '";
        ');
    }

    private static function markOrgImported(\stdClass $org, $db)
    {
        DB::connection($db)->update('
            update additional_student_affiliated_orgs set imported = 1 where organization = "' . $org->organization . '";
        ');
    }
}
