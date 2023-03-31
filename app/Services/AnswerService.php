<?php

namespace App\Services;

use App\Enums\QuestionFormat;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class AnswerService
{
    public function store(Question $question, mixed $input) :Answer
    {
        $existing = Answer::where('question_id', $question->id)->where('student_id', Auth::user()->student_id())->first();
        if (!$existing) {
            $existing = new Answer();
            $existing->student_id = Auth::user()->student_id();
            $existing->question_id = $question->id;
        }

        switch ($question->format) {
            case QuestionFormat::INPUT():
            case QuestionFormat::TEXTAREA():
                $existing->text = $input;
                break;
            case QuestionFormat::SELECT():
            case QuestionFormat::RADIO():
                $existing->text = $input; // or we can save the index
                break;
            case QuestionFormat::CHECKBOX():
                $existing->text = implode(',', array_keys($input));
                break;
        }
        $existing->save();
        return $existing;
    }
}
