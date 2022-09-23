<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /*
     *
     * select s.first_name, a.*, q.*
from students_table as s
join answers_table as a on a.student_id=s.student_id
join questions_table as q on q.question_id = a.question_id;

    select distinct question_content, count(*) as c, group_concat(curriculum) from questions_table group by question_content order by c desc;

     */
}
