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

    public static function getSummaryCounts(int $school_id) :array
    {
        return Helpers::dbQueryArray('
            select sum(active) as "active", count(*) as "total"
            from meto_students as s
            join meto_users as u on s.user_id = u.id
            join meto_user_high_schools as m on m.user_id = u.id and m.highschool_id = ' . $school_id . '
            ;
        ')[0];
    }
}
