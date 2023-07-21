<?php

namespace App\Console\Commands;

use App\Models\Answer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanDuplicateAnswers extends Command
{
    protected $signature = 'clean:duplicateAnswers';

    protected $description = 'Command description';

    public function handle()
    {
        /*
         *
         * select student_id, question_id, group_concat(id), group_concat(`response_id`), count(*)
from meto_answers
group by student_id, question_id
having count(*) > 1
order by count(*) desc;


select distinct student_id from (
select student_id, question_id, group_concat(id), group_concat(`response_id`), count(*)
from meto_answers
group by student_id, question_id
having count(*) > 1
) as d; -- 734 students

select distinct question_id from (
select student_id, question_id, group_concat(id), group_concat(`response_id`), count(*)
from meto_answers
group by student_id, question_id
having count(*) > 1
) as d; -- 265 questions


select student_id, question_id, group_concat(id) as ids, group_concat(distinct text) as texts, group_concat(distinct `response_id`) as responses, count(*) as count
            from meto_answers
            group by student_id, question_id
            having count > 1
            order by count desc; -- 18483


select student_id, question_id, q.format, q.status, group_concat(a.id) as ids, group_concat(distinct a.text) as texts, group_concat(distinct `response_id`) as responses, count(*) as count
            from meto_answers as a
            join meto_questions as q on q.id = a.question_id and q.format != 0 and q.status = 1
            group by student_id, question_id
            having count > 1
            order by count desc, question_id, student_id; -- 6408



select student_id, question_id, response_id, group_concat(id) as ids, group_concat(distinct text) as texts, count(*) as count
            from meto_answers
            group by student_id, question_id, response_id
            having count > 1
            order by count desc;




         *
         *
         *
         *
         *
        $exactDuplicates = DB::select('
        select student_id, question_id, text, response_id, text_expanded, group_concat(id) as ids, count(*) as count
            from meto_answers as a
            group by student_id, question_id, text, response_id, text_expanded
            having count > 1
            order by count desc, question_id, student_id;
        ');
        foreach ($exactDuplicates as $duplicate) {
            $this->collapseResponses($duplicate);
        }
        */

        $duplicates = DB::select('
            select student_id, question_id, group_concat(id) as ids, group_concat(distinct text) as texts, group_concat(distinct `response_id`) as responses, count(*) as count
            from meto_answers
            group by student_id, question_id
            having count > 1
            order by count desc;
        ');

        foreach ($duplicates as $duplicate) {
            if ($this->sameResponses($duplicate)) {
                $this->collapseResponses($duplicate);
            } else {
                //echo "\nStudent ID: $duplicate->student_id Question ID: $duplicate->question_id Responses: $duplicate->texts";
            }
        }
        return Command::SUCCESS;
    }

    public function sameResponses($duplicate): bool
    {
        if (!str_contains($duplicate->texts, ",")) {
            return true;
        }
        if (!is_null($duplicate->responses) && !str_contains($duplicate->responses, ",")) {
            return true;
        }
        return false;
    }

    public function collapseResponses($duplicate): void
    {
        $answer_ids = explode(",", $duplicate->ids);
        $answers = Answer::find($answer_ids);
        $i = 0;
        foreach ($answers as $answer) {
            if ($i == 0) {
                ++$i;
                continue;
            }
            $answer->delete();
        }
    }
}
