<?php

namespace App\Models;

use App\Helpers;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public static function getByQuestionID(int $question_id) :array
    {
        return Helpers::dbQueryArray('
            select
                   a.id,
                   question_id,
                   text,
                   concat(u.first, " ", u.last) as "name",
                   u.id as "user_id",
                   s.id as "student_id"
            from meto_answers as a
            join meto_students as s on a.student_id = s.id
            join meto_users as u on u.id = s.user_id
            where question_id = '. $question_id . ';
        ');
    }
}
