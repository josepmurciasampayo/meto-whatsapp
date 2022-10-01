<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public static function findByText(string $text) :?Question
    {
        $existing = Question::where('text', $text);
        if ($existing->count() == 0) {
            return null;
        } else {
            return $existing->first();
        }
    }
    /*
     *
     * select s.first_name, a.*, q.*
from students_table as s
join answers_table as a on a.student_id=s.student_id
join questions_table as q on q.question_id = a.question_id;

     */
}
