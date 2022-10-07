<?php

namespace App\Imports;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Answers
{
    public static function importFromGoogle(string $db) :int
    {
        // need to paginate through each question
        $maxQuestionID = DB::connection($db)->select('
            select max(question_id) as "id" from answers_table;
        ')[0]->id;

        for ($q = 1; $q < $maxQuestionID; ++$q) {
            $answers = DB::connection($db)->select('
                select q.question_id, question_content, s.id as student_id, response
                from answers_table as a
                join questions_table as q on q.question_id = a.question_id
                join `meto-test`.meto_students as s on s.google_id = a.student_id
                where a.imported = 0
                and a.question_id = ' . $q . ';
            ');

            foreach ($answers as $answerDB) {
                if (is_null($answerDB->student_id)) {
                    Log::channel('import')->error('Student Google ID not found: ' . $answerDB->student_id);
                    continue;
                }

                $question = Question::findByText($answerDB->question_content);
                if (is_null($question)) {
                    Log::channel('import')->error('Question not found for: ' . $answerDB->question_content);
                    continue;
                }
                self::import($answerDB, $question);
                //self::markImported($answerDB, $db);
            }
            echo "\nImported answers for question " . $q . " (" . count($answers) . " answers)";
        }
        return 1;
    }

    private static function import(\stdClass $answerDB, $question) :void
    {
        $answer = new Answer();
            $answer->question_id = $question->id;
            $answer->student_id = $answerDB->student_id;
            $answer->text = $answerDB->response;
            $answer->save();
    }

    private static function markImported(\stdClass $answerDB, string $db) :void
    {
        DB::connection($db)->update('
            update answers_table set imported = 1
            where question_id = ' . $answerDB->question_id . ' and student_id = ' . $answerDB->student_id . ';
        ');
    }
}
