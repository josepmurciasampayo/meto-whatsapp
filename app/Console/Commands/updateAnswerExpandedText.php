<?php

namespace App\Console\Commands;

use App\Enums\QuestionFormat;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Console\Command;

class updateAnswerExpandedText extends Command
{
    protected $signature = 'update:expandedText';

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
        $questions = Question::whereIn('format', [
            QuestionFormat::CHECKBOX(),
            QuestionFormat::SELECT(),
            QuestionFormat::RADIO(),
            QuestionFormat::COUNTRY(),
            QuestionFormat::COUNTRY_CHECKBOX(),
        ])->pluck('id')->toArray();

        foreach ($questions as $question) {
            $answers = Answer::where('question_id', $question)->get();
            foreach ($answers as $answer) {

            }
        }

        return Command::SUCCESS;
    }
}
