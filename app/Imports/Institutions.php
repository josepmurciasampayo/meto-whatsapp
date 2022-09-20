<?php

namespace App\Imports;

use App\Enums\Institution\Type;
use App\Enums\User\Role;
use App\Enums\User\Status;
use App\Models\Institution;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Institutions
{
    public static function importInstitutionsFromGoogle()
    {
        $query = '
            select * from institutions_table where imported = 0;
        ';
        $institutions = DB::connection('google')->select($query);
        foreach ($institutions as $institution) {
            self::importInstitution($institution);
            //self::markImported($institution);
        }
        return 0;
    }

    private static function importInstitution(\stdClass $institutionDB) {
        $institution = Institution::where('name', trim($institutionDB->inst_name))->first();
        if (!is_null($institution)) { // check for duplicates
            return; // just skip the second and later duplicates if found
        }

        $institution = new Institution();
        $institution->name = trim($institutionDB->inst_name);
        $institution->type = match($institutionDB->inst_type) {
            " " => Type::SCHOLARSHIP(),
            "University or college that awards bachelor's degrees" => Type::UNIVERSITY(),
            "Vocational or skills-based program" => Type::VOCATIONAL(),
            "Other" => Type::OTHER(),
        };
        $institution->created_at = $institutionDB->timestamp;
        $institution->google_id = $institutionDB->institution_id;
        $institution->save();

        $user = new User();
        $user->email = trim($institutionDB->user_email);
        $user->role = Role::INSTITUTION();
        $user->status = Status::ACTIVE();
        $user->first = trim($institutionDB->user_fname);
        $user->last = trim($institutionDB->user_lname);
        $user->save();

    }

    private static function markImported($institution) :void
    {
        DB::connection('google')->update('
            update institutions_table set imported = 1 where institution_id = ' . $institution->institution_id . ';
        ');
    }
}
