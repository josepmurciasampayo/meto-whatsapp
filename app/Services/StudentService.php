<?php

namespace App\Services;

use App\Enums\EnumGroup;
use App\Helpers;

class StudentService
{
    public static function getStudentsAtSchool(int $id) :array
    {
        return Helpers::dbQueryArray('
            select
                concat(u.first, " ", u.last) as "name",
                u.email,
                gender.enum_desc as "gender",
                u.phone_raw as "phone",
                u.phone_raw,
                s.dob,
                if(s.active=1, "Yes", "No") as "active",
                -- s.dob,
                sub.matches,
                -- u.id as "user_id",
                s.id as "student_id",
                ' . $id . ' as highschool_id,
                "" as school
            from meto_students as s
            join meto_users as u on s.user_id = u.id
            join meto_user_high_schools as j on j.highschool_id = ' . $id . ' and j.user_id = s.user_id
            join meto_enum as gender on gender.enum_id = s.gender and group_id = ' . EnumGroup::STUDENT_GENDER() . '
            left outer join (
            	    select s1.id, count(*) as "matches"
            	    from meto_students as s1
            	    join meto_users as u1 on s1.user_id = u1.id
            	    join meto_user_high_schools as j1 on j1.highschool_id = ' . $id . ' and j1.user_id = u1.id
            	    join meto_connections as m on s1.id = m.student_id
            	    group by s1.id
            	    ) as sub on sub.id = s.id;
        ');
    }
}
