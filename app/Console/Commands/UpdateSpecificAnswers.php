<?php

namespace App\Console\Commands;

use App\Models\Answer;
use App\Models\Question;
use App\Services\AnswerService;
use Illuminate\Console\Command;

class UpdateSpecificAnswers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-specific-answers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $a = new AnswerService();
        $question_ids = [
            308,
            260
        ];
        $questions = Question::with('answers')->find($question_ids);

        foreach ($questions as $question) {
            foreach ($question->answers as $answer) {
                $a->store($question, explode(",",$answer->text), $answer->student_id);
            }
        }
    }
}
