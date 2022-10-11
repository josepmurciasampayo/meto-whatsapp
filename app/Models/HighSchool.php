<?php

namespace App\Models;

use App\Helpers;
use \Illuminate\Database\Eloquent\Model;

class HighSchool extends Model
{
    public static function getAdminData(int $id = null) :array
    {
        $where = ($id) ? " where h.id = " . $id : '';
        $withCounselors = Helpers::dbQueryArray('
            select
                h.id, h.name, h.curriculum, h.country, h.city, h.type, count(*) as "students"
            from meto_high_schools as h
            join meto_user_high_schools as c on h.id = c.highschool_id
            ' . $where . '
            group by c.highschool_id
        ');
        if ($id) {
            return $withCounselors[0];
        }
        return $withCounselors;
    }

    public static function getByCounselorID(int $user_id) :HighSchool
    {
        $id = Helpers::dbQueryArray('
            select h.id
            from meto_high_schools as h
            join meto_user_high_schools as j on j.user_id = ' . $user_id . ' and j.highschool_id = h.id
        ')[0]['id'];

        return HighSchool::find($id);
    }
}
