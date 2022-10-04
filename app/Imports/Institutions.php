<?php

namespace App\Imports;

use App\Enums\Country\Country;
use App\Enums\Institution\Size;
use App\Enums\Institution\Type;
use App\Enums\User\Role;
use App\Enums\User\Status;
use App\Models\Institution;
use App\Models\User;
use App\Models\Joins\UserInstitution;
use Illuminate\Support\Facades\DB;

class Institutions
{
    public static function importFromGoogle(string $db) :int
    {
        $query = '
            select *
            from institutions_table as i
            join university_info as u on u.institution_id = i.institution_id
            where imported = 0;
        ';
        $institutions = DB::connection($db)->select($query);
        foreach ($institutions as $institution) {
            self::importInstitution($institution);
            self::markImported($institution, $db);
        }
        return 1;
    }

    private static function importInstitution(\stdClass $institutionDB) :void
    {
        $institution = Institution::where('name', trim($institutionDB->inst_name));
        if ($institution->count() > 0) { // check for duplicates
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
        $institution->nickname = $institutionDB->inst_nickname;
        $institution->url = $institutionDB->inst_home_url;
        $institution->city = $institutionDB->inst_city;
        $institution->state = $institutionDB->inst_state;
        $institution->country = Country::lookup($institutionDB->inst_country);
        $institution->size = match($institutionDB->inst_size) {
            'Small' => Size::SMALL(),
            'Mid-sized' => Size::MID(),
            'Large' => Size::LARGE(),
            default => Size::OTHER(),
        };
        $institution->is_public = ($institutionDB->inst_public_private == 'Public') ? 1 : 0;
        $institution->known_for = $institutionDB->known_for;
        $institution->academic_reputation = $institutionDB->acc_rep;
        $institution->majors_url = $institutionDB->majors_url;
        $institution->apply_url = $institutionDB->apply_info_url;
        $institution->extracurriculars = $institutionDB->extracurriculars_info;
        $institution->international = $institutionDB->international_info;
        $institution->application_timing = $institutionDB->app_timing;
        $institution->testing_policy = $institutionDB->test_policy;
        $institution->application_process = $institutionDB->app_process;
        $institution->student_life_url = $institutionDB->stud_life_vid_url;
        $institution->tour_url = $institutionDB->tour_vid_url;

        $institution->save();

        $user = new User();
        $user->email = trim($institutionDB->user_email);
        $user->google_id = null;
        $user->password = bcrypt('password');
        $user->role = Role::INSTITUTION();
        $user->status = Status::ACTIVE();
        $user->first = trim($institutionDB->user_fname);
        $user->last = trim($institutionDB->user_lname);
        $user->save();

        UserInstitution::joinUserInstitution($user->id, $institution->id);
    }

    private static function markImported(\stdClass $institution, string $db) :void
    {
        DB::connection($db)->update('
            update institutions_table set imported = 1 where institution_id = ' . $institution->institution_id . ';
        ');
    }
}
