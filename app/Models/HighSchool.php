<?php

namespace App\Models;

use App\Helpers;
use \Illuminate\Database\Eloquent\Model;

class HighSchool extends Model
{
    public static function getAdminData() :array
    {
        $withCounselors = Helpers::dbQueryArray('
            select
            h.id, h.name, h.curriculum, h.country, count(*) as "students"
            from meto_high_schools as h
            join meto_user_high_schools as c on h.id = c.highschool_id
            group by c.highschool_id
        ');

        return $withCounselors;
    }
}
