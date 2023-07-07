<?php

namespace App\Console\Commands;

use App\Enums\QuestionFormat;
use App\Helpers;
use App\Models\Answer;
use App\Models\Response;
use App\Models\Student;
use App\Services\AnswerService;
use App\Services\EquivalencyService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class convertStudentAnswers extends Command
{
    protected $signature = 'convert:studentAnswers';

    protected $description = 'Command description';

    public function handle(): int
    {
        //$this->updateResponseIDs();

        //$this->updateQuestions();

        //$this->mergeQuestions();
        //$this->changeResponses();
        $this->calculateEquivalencies();
        return Command::SUCCESS;
    }

    public function updateResponseIDs(): void
    {
        // update response ID's for old questions
        $formats = [
            QuestionFormat::SELECT(),
            QuestionFormat::RADIO(),
            QuestionFormat::CHECKBOX(),
        ];

        $question_ids = \App\Models\Question::whereIn('format', $formats)->get()->pluck('id')->toArray();
        $answers = Answer::whereIn('question_id', $question_ids)->get();
        $responses = Response::whereIn('question_id', $question_ids)->get();

        $responseArray = array();
        foreach ($responses as $response) {
            $responseArray[$response->question_id][$response->text] = $response->id;
        }

        // update answers by looking up responses
        echo "\nAbout to update " . count($answers) . " answers with response IDs";
        foreach ($answers as $answer) {
            if (isset($responseArray[$answer->question_id][$answer->text])) {
                $answer->response_id = $responseArray[$answer->question_id][$answer->text];
                $answer->save();
            }
        }

        echo "\nResponse IDs are updated\n";
    }

    public function updateQuestions(): void
    {
        DB::update('update meto_students set efc = null, countryHS = null, curriculum = null, citizenship = null, citizenship_extra = null, track = null, destination = null, gender = null, ranking = null, det = null, act = null, toefl = null, ielts = null, affiliations = null, refugee = null, disability = null, dob = null, email_owner = null, submission_device = null, birth_city = null, birth_country = null;');

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
        foreach ($questions as $question_id => $field) {
            $answers = Answer::where('question_id', $question_id)->get();
            echo "\nAbout to update " . count($answers) . " answers into student table";
            foreach ($answers as $answer) {
                (new AnswerService())->updateStudent($answer->student, $answer->question_id, $answer->expanded_text ?? $answer->text);
            }
        }

        echo "\nQuestions are updated\n";
    }

    public function mergeQuestions(): void
    {
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

        echo "\nQuestions are merged";
    }

    public function changeResponses(): void
    {
        // change responses
        DB::update("UPDATE meto_answers SET `text` = REPLACE(SUBSTRING_INDEX(`text`, '-', 1), ' ', '') WHERE question_id = 244;");
        DB::update("UPDATE meto_answers SET `text` = IFNULL(REGEXP_SUBSTR(`text`, '^\\$\\d+'), `text`) WHERE question_id = 244;");
        DB::update("UPDATE meto_answers SET `text` = '$500' WHERE `text` = '$400' AND question_id = 244;");
        DB::update("UPDATE meto_answers SET `text` = '$500' WHERE `text` = '500' AND question_id = 244;");
        DB::update("UPDATE meto_answers SET `text` = '$2000' WHERE `text` = '2000' AND question_id = 244;");

        echo "\nQueries are run";
    }

    public function calculateEquivalencies(): void
    {
        echo "\nProcessing equivalencies";
        $students = Student::all();
        foreach ($students as $student) {
            (new EquivalencyService())->update($student);
        }
        echo "\nEquivalencies are processed";
    }

    public function mergeQuestion(Answer $answer, $new_question_id): void
    {
        $answer->question_id = $new_question_id;
        $answer->save();
    }
}
