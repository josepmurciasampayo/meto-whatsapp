<?php

namespace App\Imports;

use App\Helpers;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Answers
{
    public static function importFromGoogle(string $db) :int
    {
        $answerCount = 0;
        // need to paginate through each question
        $maxQuestionID = DB::connection($db)->select('
            select max(question_id) as "id" from answers_table;
        ')[0]->id;

        $array = Helpers::dbQueryArray('
            select s.id as "student_id", u.google_id as "google_id"
            from meto_students as s
            join meto_users as u on u.id = s.user_id;
        ');
        $toReturn = array();
        foreach ($array as $row) {
            $toReturn[$row['google_id']] = $row['student_id'];
        }

        $studentLookup = $toReturn;

        for ($q = 1; $q <= $maxQuestionID; ++$q) {
            $answers = DB::connection($db)->select('
                select q.question_id, q.question_content, a.student_id, a.response
                from answers_table as a
                join questions_table as q on q.question_id = a.question_id
                where a.imported = 0
                and a.question_id = ' . $q . ';
            ');
            if (!isset($answers[0])) {
                // echo "\nSkipped question " . $q;
                continue;
            }

            $question = Question::where('text', $answers[0]->question_content)->first();
            if (is_null($question)) {
                Log::channel('import')->error('Question not found for: ' . $answers[0]->question_content . ' (question ' . $q . ')');
                continue;
            }

            $insertQuery = "insert into meto_answers (question_id, student_id, text) values ";

            foreach ($answers as $answerDB) {
                // don't need to check dupes - DB enforces unique student_id & question_id
                $insertQuery .= '(' . $question->id . ',' . $studentLookup[$answerDB->student_id] . ', "' . addslashes($answerDB->response) . '"),';
                $answerCount++;
            }

            DB::insert(rtrim($insertQuery, ","));

            DB::connection($db)->update("update answers_table set imported = 1 where question_id = " . $q);
        }

        Log::channel('import')->info("Imported " . $answerCount);

        return 1;
    }

    private static function import(\stdClass $answerDB, Question $question, array $studentLookup) :void
    {
        $answer = new Answer();
        $answer->question_id = $question->id;
        $answer->student_id = $studentLookup[$answerDB->student_id];
        $answer->text = $answerDB->response;
        $answer->save();
    }

}
