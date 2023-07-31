<?php

namespace App\Console\Commands;

use App\Models\Answer;
use App\Services\AnswerService;
use Illuminate\Console\Command;

class UpdateStudentDataFromAnswers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-student-data-from-answers';

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
        $questions = [
            /* question ID => question column in the student table */
            318 => 'curriculum',
            244 => 'efc',
            104 => 'countryHS',
            288 => 'citizenship',
            290 => 'citizenship_extra',
            13 => 'track',
            260 => 'destination',
            271 => 'gender',
            44 => 'ranking',
            69 => 'det',
            67 => 'act',
            73 => 'toefl',
            70 => 'ielts',
            164 => 'affiliations',
            285 => 'refugee',
            308 => 'disability',
            275 => 'dob',
            296 => 'email_owner',
            312 => 'submission_device',
            283 => 'birth_city',
            281 => 'birth_country',
        ];
        foreach ($questions as $question_id => $field) {
            $answers = Answer::where('question_id', $question_id)->get();
            echo "\nAbout to update " . count($answers) . " answers into student table";
            foreach ($answers as $answer) {
                $answer->updateStudent();
            }
        }

        echo "\nQuestions are updated\n";
    }
}
