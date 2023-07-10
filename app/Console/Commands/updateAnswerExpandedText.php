<?php

namespace App\Console\Commands;

use App\Enums\QuestionFormat;
use App\Models\Answer;
use App\Models\EnumCountry;
use App\Models\Question;
use Illuminate\Console\Command;

class updateAnswerExpandedText extends Command
{
    protected $signature = 'update:expandedText';

    protected $description = 'Command description';

    public function handle(): int
    {
        $countries = EnumCountry::orderBy('name', 'asc')->get();
        $country_array = [];
        foreach ($countries as $country) {
            $country_array[$country->id] = $country->name;
        }

        $country_checkbox = Question::where('format', QuestionFormat::COUNTRY_CHECKBOX())->pluck('id')->toArray();
        $answers = Answer::whereIn('question_id', $country_checkbox)->get();
        foreach ($answers as $answer) {
            $answer_countries_expanded = [];
            $answer_countries_ids = explode(",", $answer->text);
            if (is_numeric($answer->text)) {
                foreach ($answer_countries_ids as $a) {
                    $answer_countries_expanded[] = $countries[$a];
                }
                $answer->expanded_text = implode(", ", $answer_countries_expanded);
            } else {
                $answer->expanded_text = $answer->text;
            }
        }

        return Command::SUCCESS;

        $questions = Question::whereIn('format', [
            QuestionFormat::CHECKBOX(),
            QuestionFormat::SELECT(),
            QuestionFormat::RADIO(),
            QuestionFormat::COUNTRY(),
        ])->pluck('id')->toArray();

        foreach ($questions as $question) {
            $answers = Answer::where('question_id', $question)->get();
            foreach ($answers as $answer) {
                // need to explode and then look up response ID's
            }
        }

    }
}
