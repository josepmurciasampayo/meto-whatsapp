<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers;

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
            where users.id = " . $user_id . ";
        ');
    }
}
