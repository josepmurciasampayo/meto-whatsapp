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
        $result = DB::select('
            select
                   ifnull(notes, "") as "notes"
            from meto_user_high_schools
            where user_id = ' . $user_id . ' and role in (' . Role::COUNSELOR() . ', ' . Role::ADMIN() . ');'
        );
        return $result[0]->notes;
    }

}
