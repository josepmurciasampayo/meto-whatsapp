<?php

namespace App\Models;

use App\Enums\EnumGroup;
use App\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    public static function countMatches(int $user_id) :int
    {
        $toReturn = DB::select('
                select count(*) as c
                from meto_users as u
                join meto_students as s on s.user_id = u.id
                join meto_match_student_institutions as m on m.student_id = s.id
                where u.id = ' . $user_id . '
            ');
        return $toReturn[0]->c;
    }

    public static function getAdminData() :array
    {
        return Helpers::dbQueryArray('
            select
                concat(u.first, " ", u.last) as "name",
                u.email,
                gender.enum_desc as "gender",
                s.dob,
                a.text as "school"
            from meto_students as s
            join meto_users as u on s.user_id = u.id
            join meto_enum as gender on gender.enum_id = s.gender and group_id = ' . EnumGroup::STUDENT_GENDER() . '
            left outer join meto_answers as a on student_id = s.id and question_id = 118
        ');
    }
}
