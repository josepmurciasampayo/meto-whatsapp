<?php

namespace App\Imports;

use App\Enums\Student\Curriculum;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class Questions
{
    public static function importFromGoogle($db) :int
    {
        $rwandan = Curriculum::RWANDAN();
        $kenyan = Curriculum::KENYAN();
        $ugandan = Curriculum::UGANDAN();
        $american = Curriculum::AMERICAN();
        $cambridge = Curriculum::CAMBRIDGE();
        $ib = Curriculum::IB();
        $uni = Curriculum::TRANSFER();
        $other = Curriculum::OTHER();

        $questions = DB::connection($db)->select('
            select distinct question_content, group_concat(curriculum) as "curricula"
            from questions_table
            group by question_content
        ');

        foreach ($questions as $questionDB) {
            $question = new Question();
            $question->text = $questionDB->question_content;
            $question->$rwandan = str_contains($questionDB->curricula, 'rwandan');
            $question->$kenyan = str_contains($questionDB->curricula, 'kenyan');
            $question->$ugandan = str_contains($questionDB->curricula, 'ugandan');
            $question->$american = str_contains($questionDB->curricula, 'american');
            $question->$cambridge = str_contains($questionDB->curricula, 'cambridge');
            $question->$ib = str_contains($questionDB->curricula, 'ib');
            $question->$uni = str_contains($questionDB->curricula, 'uni_transfer');
            $question->$other = str_contains($questionDB->curricula, 'all_other');
            $question->save();
        }

        DB::unprepared(file_get_contents(database_path('seeders/questions_in_use.sql')));

        return 1;

    }
}
