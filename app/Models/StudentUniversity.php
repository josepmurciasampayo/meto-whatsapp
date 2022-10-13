<?php

namespace App\Models;

use App\Enums\EnumGroup;
use Illuminate\Database\Eloquent\Model;
use App\Helpers;
use Illuminate\Support\Facades\DB;

class StudentUniversity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'institution_id',
        'change_date',
        'status'
    ];

    public static function getByUserID(int $user_id) :array
    {
        return Helpers::dbQueryArray('
            select
                matches.id as match_id,
                user_id,
                institution_id,
                matches.status,
                first,
                last,
                name
            from meto_student_universities as matches
            join meto_students as students on matches.student_id = students.id
            join meto_users as users on students.user_id = users.id
            join meto_institutions as institutions on matches.institution_id = institutions.id
            where users.id = ' . $user_id . ';
        ');
    }

    public static function updateMatchStatusByMatchID(int $match_id, int $status, int $user_id = null) :void
    {
        if (is_null($user_id)) { // run by system/admin
            DB::update('
                update meto_student_universities
                set status = ' . $status . '
                where id = ' . $match_id . ';
            ');
            return;
        }

        DB::update('
            update meto_student_universities as m
            join meto_students as s on s.user_id = ' . $user_id .'
            set status = ' . $status . '
            where m.id = ' . $match_id . '
            and student_id = s.id;
        ');
    }

    public static function getMatchData() :array
    {
        // TODO: add high school name and country and last update date
        return Helpers::dbQueryArray('
            select
                m.id as match_id,
                m.student_id,
                institution_id,
                m.status,
                enum_desc as match_status,
                m.created_at as match_date,
                u.first,
                u.last,
                i.name,
                a.text as "school"
            from meto_student_universities as m
            join meto_students as s on student_id = s.id
            join meto_users as u on s.user_id = u.id
            join meto_institutions as i on institution_id = i.id
            join meto_enum as match_status on match_status.group_id = ' . EnumGroup::GENERAL_MATCH() . ' and m.status = enum_id
            left outer join meto_answers as a on a.student_id = s.id and a.question_id = 118;
        ');
    }

    public static function getMatchesByHighSchool(int $highschool_id) :array
    {
        return Helpers::dbQueryArray('
            select
                u.id as "user_id",
                s.id as "student_id",
                concat(u.first, " ", u.last) as "name",
                u.email,
                i.id as "institution_id",
                i.name as "institution_name",
                m.created_at as "date",
                status.enum_desc as "status"
            from meto_students as s
            join meto_users as u on s.user_id = u.id
            join meto_user_high_schools as h on h.user_id = u.id and h.highschool_id = 1 and h.id = ' . $highschool_id .'
            join meto_student_universities as m on m.student_id = s.id
            join meto_institutions as i on m.institution_id = i.id
            join meto_high_schools as hs on h.highschool_id = hs.id
            join meto_enum as status on status.enum_id = m.status and status.group_id = ' . EnumGroup::GENERAL_MATCH() . ';
        ');
    }
}
