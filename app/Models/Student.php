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
                from meto_student_universities as u
                join meto_students as s on s.user_id = u.id
                join meto_student_universities as m on m.student_id = s.id
                where u.id = ' . $user_id . '
            ');
        return $toReturn[0]->c;
    }

    public static function getAdminData() :array
    {
        return Helpers::dbQueryArray('
            select
                s.id as "student_id",
                u.id as "user_id",
                concat(u.first, " ", u.last) as "name",
                u.email,
                gender.enum_desc as "gender",
                s.dob,
                u.phone_raw,
                h.name as "school",
                ifnull(h.id, 0) as "highschool_id",
                ifnull(sub.matches, 0) as "matches"
            from meto_students as s
            join meto_users as u on s.user_id = u.id
            left outer join meto_user_high_schools as j on j.user_id = u.id
            join meto_enum as gender on gender.enum_id = s.gender and group_id = ' . EnumGroup::STUDENT_GENDER() . '
            left outer join meto_high_schools as h on j.highschool_id = h.id
            left outer join (
            	select s1.id, count(*) as "matches" from meto_students as s1 join meto_student_universities as m on s1.id = m.student_id group by s1.id
            	) as sub on sub.id = s.id;
        ');
    }

    public static function getStudentsAtSchool(int $id) :array
    {
        return Helpers::dbQueryArray('
            select
                concat(u.first, " ", u.last) as "name",
                u.email,
                gender.enum_desc as "gender",
                u.phone_raw as "phone",
                if(s.active=1, "Yes", "No") as "active",
                -- s.dob,
                sub.matches,
                -- u.id as "user_id",
                s.id as "student_id"
            from meto_students as s
            join meto_users as u on s.user_id = u.id
            join meto_user_high_schools as j on j.highschool_id = ' . $id . ' and j.user_id = s.user_id
            join meto_enum as gender on gender.enum_id = s.gender and group_id = ' . EnumGroup::STUDENT_GENDER() . '
            left outer join (
            	    select s1.id, count(*) as "matches"
            	    from meto_students as s1
            	    join meto_users as u1 on s1.user_id = u1.id
            	    join meto_user_high_schools as j1 on j1.highschool_id = ' . $id . ' and j1.user_id = u1.id
            	    join meto_student_universities as m on s1.id = m.student_id
            	    group by s1.id
            	    ) as sub on sub.id = s.id;
        ');
    }

    public static function getStudentData(int $student_id) :array
    {
        return Helpers::dbQueryArray('
            select
                concat (u.first, " ", u.last) as "name",
                u.id as "user_id",
                s.id as "student_id",
                q.text as "question",
                q.id as "question_id",
                a.text as "answer",
                s.verify,
                s.verify_notes
            from meto_students as s
            join meto_users as u on s.user_id = u.id
            join meto_answers as a on a.student_id = s.id
            join meto_questions as q on q.id = a.question_id
            where student_id = ' . $student_id . '
            order by type, question_id;
        ');
    }
}
