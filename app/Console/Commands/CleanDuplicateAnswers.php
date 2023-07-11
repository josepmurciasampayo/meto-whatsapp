<?php

namespace App\Console\Commands;

use App\Models\Answer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanDuplicateAnswers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:duplicateAnswers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $exactDuplicates = DB::select('
        select student_id, question_id, text, response_id, group_concat(id) as ids, count(*) as count
            from meto_answers as a
            group by student_id, question_id, text, response_id
            having count > 1
            order by count desc, question_id, student_id;
        ');
        foreach ($exactDuplicates as $duplicate) {
            $this->collapseResponses($duplicate);
        }
        return Command::SUCCESS;

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
