<?php

namespace App\Models;

use App\Enums\EnumGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers;
use Illuminate\Support\Facades\DB;

class MatchStudentInstitution extends Model
{
    use HasFactory;

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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

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
            from meto_match_student_institutions as matches
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
                update meto_match_student_institutions
                set status = ' . $status . '
                where id = ' . $match_id . ';
            ');
            return;
        }
        DB::update('
            update meto_match_student_institutions as m
            join meto_students as s on s.user_id = ' . $user_id .'
            set status = ' . $status . '
            where m.id = ' . $match_id . '
            and student_id = s.id;
        ');
    }

    public static function getMatchData() :array
    {
        return Helpers::dbQueryArray('
            select
                m.id as match_id,
                student_id,
                institution_id,
                m.status,
                enum_desc as match_status,
                m.created_at as match_date,
                u.first,
                u.last,
                i.name
            from meto_match_student_institutions as m
            join meto_students as s on student_id = s.id
            join meto_users as u on s.user_id = u.id
            join meto_institutions as i on institution_id = i.id
            join meto_enum as match_status on match_status.group_id = ' . EnumGroup::GENERAL_MATCH() . ' and m.status = enum_id
        ');
    }
}
