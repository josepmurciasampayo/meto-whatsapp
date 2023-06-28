<?php

namespace App\Models;

use App\Enums\General\YesNo;
use App\Enums\QuestionFormat;
use App\Enums\Student\Curriculum;
use App\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Fluent;

class Question extends Model
{
    /*
     * id
     * text
     * type
     * order
     * format
     * status
     * required
     * help
     * a column for each curriculum
     */

    public function curriculum(int $curriculum, bool $inUse = null) :bool
    {
        $questionCurricula = QuestionCurricula::where('curriculum_id', $curriculum)
            ->where('question_id', $this->id)
            ->first();
        $questionCurricula = $questionCurricula ?: $this->attachQuestionToCurricula($curriculum);

        if (!is_null($inUse) && $curriculum < 9) {
            $value = ($inUse) ? YesNo::YES() : YesNo::NO();
            $update = "update meto_questions set `" . $curriculum . "` = " . $value . " where id = " . $this->id . ';';
            $questionCurricula->update([
                'is_school_choice' => false
            ]);
            DB::update($update);
            return true;
        } else {
            $questionCurricula->update([
                'is_school_choice' => false
            ]);
            return $this->$curriculum == YesNo::YES();
        }
    }

    public static function hasResponses(Fluent $question) :bool
    {
        return in_array($question->format, QuestionFormat::hasResponses());
    }

    public function requiredString(): string
    {
        if (!$this->exists) { // for admin creating a question
            return false;
        }
        return ($this->required == YesNo::YES()) ? "true" : "false";
    }

    public function attachQuestionToCurricula(int $curriculum)
    {
//        return QuestionCurricula::create([
//            'curriculum_id' => $curriculum,
//            'question_id' => $this->id,
//            'screen' => ,
//            'order' => request('order'),
//            'branching' => ,
//            'destination_screen' =>
//        ]);
    }
}
