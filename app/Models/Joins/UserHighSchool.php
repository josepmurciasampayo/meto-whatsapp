<?php

namespace App\Models\Joins;

use App\Enums\HighSchool\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserHighSchool extends Model
{
    public static function joinUserHighSchool(int $user_id, int $highschool_id, Role $role) :UserHighSchool
    {
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

}
