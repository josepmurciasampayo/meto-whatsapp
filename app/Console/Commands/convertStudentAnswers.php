<?php

namespace App\Console\Commands;

use App\Enums\Question;
use App\Enums\QuestionFormat;
use App\Enums\Student\QuestionType;
use App\Models\Answer;
use App\Models\Response;
use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class convertStudentAnswers extends Command
{
    protected $signature = 'convert:studentAnswers';

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
        // udpate student data
        $questions = [
            /* question ID => question column in the student table */
            244 => 'efc',
            104 => 'countryHS',
            318 => 'curriculum',
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
        $answers = Answer::whereIn('question_id', array_keys($questions))->get();
        foreach ($answers as $answer) {
            $this->updateStudent($answer, $questions[$answer->question_id]);
        }

        // merge questions
        $questions = [
            105 => 104,
            249 => 370,
            247 => 119,
            246 => 119,
            218 => 119,
        ];
        $answers = Answer::whereIn('question_id', array_keys($questions))->get();
        foreach ($answers as $answer) {
            $this->mergeQuestion($answer, $questions[$answer->question_id]);
        }

        // change responses
        DB::update("UPDATE meto_answers SET `text` = REPLACE(SUBSTRING_INDEX(`text`, '-', 1), ' ', '') WHERE question_id = 244;");
        DB::update("UPDATE meto_answers SET `text` = IFNULL(REGEXP_SUBSTR(`text`, '^\\$\\d+'), `text`) WHERE question_id = 244;");
        DB::update("UPDATE meto_answers SET `text` = '$500' WHERE `text` = '$400' AND question_id = 244;");
        DB::update("UPDATE meto_answers SET `text` = '$500' WHERE `text` = '500' AND question_id = 244;");
        DB::update("UPDATE meto_answers SET `text` = '$2000' WHERE `text` = '2000' AND question_id = 244;");

        // update response ID's for old questions
        $formats = [
            QuestionFormat::SELECT(),
            QuestionFormat::RADIO(),
            QuestionFormat::CHECKBOX(),
        ];
        foreach ($formats as $format) {
            // get question_ids
            $question_ids = \App\Models\Question::whereIn('format', $formats)->get()->pluck('id')->toArray();

            // get answers and response array
            $answers = Answer::whereIn('question_id', \App\Models\Question::whereIn('format', $formats)->get()->pluck('id')->toArray())->get();
            $responses = Response::whereIn('question_id', $question_ids)->get();
            $responseArray = array();
            foreach ($responses as $response) {
                $responseArray[$response->question_id][$response->text] = $response->id;
            }

            // update answers by looking up responses
            foreach ($answers as $answer) {
                if (isset($responseArray[$answer->question_id][$answer->text])) {
                    $answer->response_id = $responseArray[$answer->question_id][$answer->text];
                }
            }

            // set form completed
        }

        return Command::SUCCESS;
    }

    public function updateStudent(Answer $answer, string $field): void
    {
        $student = Student::find($answer->student_id);
        $student->update([
            $field => $answer->text_expanded ?? $answer->text,
        ]);
        $student->save();
    }

    public function mergeQuestion(Answer $answer, $new_question_id): void
    {
        $answer->question_id = $new_question_id;
        $answer->save();
    }
}
