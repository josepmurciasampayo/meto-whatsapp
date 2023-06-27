<?php

namespace App\Models;

use App\Console\Commands\reloadEnums;
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
        'status',
        'application_link',
        'deadline',
        'events',
        'requester_id',
        'student_response'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class);
    }

    public static function getByUserID(int $user_id) :array
    {
        return Helpers::dbQueryArray('
            select
                matches.id as match_id,
                user_id,
                student_id,
                institution_id,
                matches.status as status_id,
                match_status.enum_desc as "status",
                first,
                last,
                name
            from meto_student_universities as matches
            join meto_students as students on matches.student_id = students.id
            join meto_users as users on students.user_id = users.id
            join meto_institutions as institutions on matches.institution_id = institutions.id
            join meto_enum as match_status on match_status.group_id = ' . EnumGroup::GENERAL_MATCH()  . ' and match_status.enum_id = matches.status
            where users.id = ' . $user_id . ';
        ');
    }

    public static function updateMatchStatusByMatchID(int $match_id, int $status, int $user_id = null) :void
    {
        if (is_null($user_id)) { // run by system/admin/counselor
            Helpers::dbUpdate('
                update meto_student_universities
                set status = ' . $status . '
                where id = ' . $match_id . ';
            ');
            return;
        }

        Helpers::dbUpdate('
            update meto_student_universities as m
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
                m.student_id,
                institution_id,
                m.status as status_code,
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
                m.status as status_code,
                if(s.active = 1, "Yes", "No") as "active",
                status.enum_desc as "status"
            from meto_students as s
            join meto_users as u on s.user_id = u.id
            join meto_user_high_schools as h on h.user_id = u.id and h.highschool_id = ' . $highschool_id .'
            join meto_student_universities as m on m.student_id = s.id
            join meto_institutions as i on m.institution_id = i.id
            join meto_high_schools as hs on h.highschool_id = hs.id
            join meto_enum as status on status.enum_id = m.status and status.group_id = ' . EnumGroup::GENERAL_MATCH() . ';
        ');
    }

    public static function getMatchesByUniversityID(int $university_id) :array
    {
        return Helpers::dbQueryArray('select
                m.student_id,
                u.id as "user_id",
                m.intent,
                m.heardOf
            from meto_student_universities as m
            join meto_students as s on s.id = m.student_id
            join meto_users as u on s.user_id = u.id
            where m.intent is null and
            institution_id = ' . $university_id . ';'
        );
    }

    public static function getIntentByUserAndUniversity(int $user_id, int $university_id) :?int
    {
        $toReturn = Helpers::dbQueryArray('
            select
            intent
            from meto_student_universities as m
            join meto_students as s on s.user_id = ' . $user_id . '
            where m.student_id = s.id and m.institution_id = ' . $university_id . ';
        ');
        return $toReturn[0]['intent'];
    }

    public static function updateFactors(int $user_id, array $factors) :void
    {
        $factorString = implode(",", $factors);
        $student_id = Student::where('user_id', $user_id)->first()->id;
        Helpers::dbUpdate('
            update meto_student_universities set factors = "' . $factorString . '" where student_id = ' . $student_id . ' and institution_id = 77
        ');
    }
}
