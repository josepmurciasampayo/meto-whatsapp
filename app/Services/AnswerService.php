<?php

namespace App\Services;

use App\Enums\QuestionFormat;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class AnswerService
{
    public function store(Question $question, mixed $input): Answer
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
            case QuestionFormat::DATE():
            case QuestionFormat::EMAIL():
            case QuestionFormat::NUMBER():
            case QuestionFormat::DOLLAR():
            case QuestionFormat::LOOKUP():
            case QuestionFormat::LOOKUPORG():
            case QuestionFormat::COUNTRY():
                //dd($input);
                $existing->text = $input;
                break;
            case QuestionFormat::PHONE():
            case QuestionFormat::SELECTWITHOTHER():
                $existing->text = json_encode($input);
                break;
            case QuestionFormat::SELECT():
            case QuestionFormat::RADIO():
                $existing->response_id = $input;
                $response = \App\Models\Response::find($existing->response_id);
                $existing->text = $response->text; // or we can save the index
                break;
            case QuestionFormat::CHECKBOX():
                $existing->text = implode(',', array_keys($input));
                break;
            case QuestionFormat::COUNTRY_CHECKBOX():
                $existing->text = implode(',', $input);
                break;
            default:

        }
        $existing->save();
        return $existing;
    }

    public function getForQuestionArray(array $questions) :array
    {
        $question_ids = array();
        foreach ($questions as $id => $question) {
            $question_ids[] = $id;
        }
        $answers = Answer::whereIn('question_id', $question_ids)->where('student_id', Auth::user()->student_id())->get();
        $answerArray = array();
        foreach ($answers as $answer) {
            $answerArray[$answer->question_id] = $answer;
        }

        return $answerArray;
    }
}
