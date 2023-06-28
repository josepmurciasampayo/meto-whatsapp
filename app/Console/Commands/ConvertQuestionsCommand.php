<?php

namespace App\Console\Commands;

use App\Enums\General\YesNo;
use App\Helpers;
use App\Models\Question;
use App\Models\QuestionCurriculum;
use Illuminate\Console\Command;

class ConvertQuestionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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
        $questions = Helpers::dbQueryArray('
            select question_id, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, type, s.order, format, required, equivalency, curriculum, s.screen, branch, destination_screen
            from meto_questions as q
            join meto_question_screens as s on s.question_id = q.id
        ');

        foreach ($questions as $question) {
            for ($i =1; $i < 9; ++$i) {
                if ($question->$i == YesNo::YES()) {
                    $join = new QuestionCurriculum();
                    $join->question_id = $question->id;
                    $join->curriculum_id = $i;

                }

            }
        }
        return Command::SUCCESS;
    }
}
