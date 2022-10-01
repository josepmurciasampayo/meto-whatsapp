<?php

namespace App\Imports;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

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
                select q.question_id, question_content, student_id, response
                from answers_table as a
                join questions_table as q on q.question_id = a.question_id
                where a.imported = 0
                and a.question_id = ' . $q . ';
            ');

            foreach ($answers as $answerDB) {
                self::import($answerDB);
                self::markImported($answerDB, $db);
            }
        }
        return 1;
    }

    private static function import(\stdClass $answerDB) :void
    {
        $answer = new Answer();
        $question = Question::findByText($answerDB->question_content);
        if (is_null($question)) {
            return;
        }
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
