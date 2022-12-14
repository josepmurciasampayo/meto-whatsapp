<?php

namespace App\Models\Joins;

use App\Enums\HighSchool\Role;
use App\Helpers;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserHighSchool extends Model
{
    public static function joinUserHighSchool(int $user_id, int $highschool_id, Role $role) :UserHighSchool
    {
        $existing = UserHighSchool::where('user_id', $user_id)->where('highschool_id', $highschool_id)->get();
        if ($existing->first()) {
            return $existing->first();
        }
        $new = new UserHighSchool();
        $new->user_id = $user_id;
        $new->highschool_id = $highschool_id;
        $new->role = $role();
        $new->save();

        return $new;
    }

    public static function getNotes(int $user_id) :string
    {
        if (Auth()->user()->role == \App\Enums\User\Role::ADMIN()) {
            return "ADMIN USERS CANNOT READ OR SAVE NOTES";
        }

        $result = DB::select('
            select
                   ifnull(notes, "") as "notes"
            from meto_user_high_schools
            where user_id = ' . $user_id . ';'
        );
        return $result[0]->notes;
    }

    public static function getByCounselorUserID(int $user_id) :UserHighSchool
    {
        return UserHighSchool::where('user_id', $user_id)->first();
    }

    public static function updateRole(int $user_id, Role $role) :void
    {
        Helpers::dbUpdate('
            update meto_user_high_schools set role = ' . $role() . ' where user_id = ' . $user_id . ';
        ');
    }

    public static function remove(int $student_id, int $highschool_id) :void
    {
        $user_id = User::getIDbyStudentID($student_id);

        Helpers::dbUpdate('delete from meto_user_high_schools where user_id = ' . $user_id . ' and highschool_id = ' . $highschool_id . '; ');
    }
}
