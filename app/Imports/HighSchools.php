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
        $schools = DB::connection($db)->select(' select * from counselors_table where imported = 0; ');
        foreach ($schools as $school) {
            if (self::checkDupeSchool($school)) {
                self::markSchoolImported($school, $db);
                continue;
            }
            self::importSchool($school);
            self::markSchoolImported($school, $db);
        }

        $orgs = DB::connection($db)->select(' select * from additional_student_affiliated_orgs where imported = 0; ');
        foreach ($orgs as $org) {
            self::importOrg($org);
            self::markOrgImported($org, $db);
        }
    }

    private static function checkDupeSchool(\stdClass $school) :bool
    {
        $existing = DB::select('
            select id from meto_high_schools where name = "' . $school->high_school . '";
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

        if (strlen($org->user_email) == 0) {
            return;
        }
        $user = new User();
        $user->email = $org->user_email;
        $user->role = Role::COUNSELOR();
        $user->status = Status::ACTIVE();
        $user->save();

        UserHighSchool::joinUserHighSchool($user->id, $hs->id, \App\Enums\HighSchool\Role::ADMIN);
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
