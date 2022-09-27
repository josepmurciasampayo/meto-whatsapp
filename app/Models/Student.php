<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
}
