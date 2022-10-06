<?php

namespace App\Models\Joins;

use App\Enums\General\HighSchoolRole;
use Illuminate\Database\Eloquent\Model;

class UserHighSchools extends Model
{
    public static function joinUserHighSchool(int $user_id, int $highschool_id, HighSchoolRole $role) :UserHighSchools
    {
        $new = new UserHighSchools();
        $new->user_id = $user_id;
        $new->highschool_id = $highschool_id;
        $new->role = $role();
        $new->save();

        return $new;
    }
}