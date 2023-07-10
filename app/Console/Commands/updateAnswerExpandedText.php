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
        $unmatchedCountries = [];

        $country_id_array = [];
        foreach ($countries as $country) {
            $country_id_array[$country->id] = $country->name;
        }

        $country_name_array = [];
        foreach ($countries as $country) {
            $country_name_array[$country->name] = $country->id;
        }
        $country_name_array['United States of America'] = 235;
        $country_name_array['United Kingdom'] = 234;
        $country_name_array['South Korea'] = 119;
        $country_name_array['Russia'] = 183;
        $country_name_array['Tanzania'] = 219;
        $country_name_array['Vietnam'] = 241;
        $country_name_array['Congo (Congo-Brazzaville)'] = 50;
        $country_name_array['Democratic Republic of the Congo'] = 51;
        $country_name_array['Syria'] = 216;
        $country_name_array["Côte d''Ivoire"] = 54;

        $answers = Answer::with('student')->where('question_id', 260)->get();
        foreach ($answers as $answer) {
            $answer_countries_expanded = [];

            if (strlen($answer->text) > 1) {
                if (is_numeric($answer->text[0])) {
                    $answer_ids = explode(",", $answer->text);
                    foreach ($answer_ids as $id) {
                        $answer_countries_expanded[] = $country_id_array[$id];
                    }
                    $answer->text_expanded = implode(", ", $answer_countries_expanded);
                } else {
                    $answer_names = explode(", ", $answer->text);
                    $answer->text_expanded = $answer->text;

                    foreach ($answer_names as $name) {
                        if (isset($country_name_array[$name])) {
                            $answer_countries_expanded[] = $country_name_array[$name];
                        } else {
                            $unmatchedCountries[$name] = 1;
                        }
                    }
                    $answer->text = implode(",", $answer_countries_expanded);
                }
                $answer->save();

                $answer->student->destination = $answer->text_expanded;
                $answer->student->save();
            }
        }

        print_r(implode(", ", array_keys($unmatchedCountries)));



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
