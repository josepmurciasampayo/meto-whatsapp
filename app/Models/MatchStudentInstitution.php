<?php

namespace App\Models;

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
}
