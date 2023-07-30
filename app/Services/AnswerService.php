<?php

namespace App\Services;

use App\Enums\QuestionFormat;
use App\Enums\Student\Curriculum;
use App\Helpers;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Response;
use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
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
            case QuestionFormat::DATE():
            case QuestionFormat::INPUT():
            case QuestionFormat::TEXTAREA():
            case QuestionFormat::EMAIL():
            case QuestionFormat::NUMBER():
            case QuestionFormat::LOOKUP():
            case QuestionFormat::LOOKUPORG():
            case QuestionFormat::COUNTRY():
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
                $responses = Response::select('text')->whereIn('id', array_keys($input))->get()->pluck('text')->toArray();
                $existing->text_expanded = implode(", ", $responses);
                break;
            case QuestionFormat::COUNTRY_CHECKBOX():
                $existing->text = implode(',', $input);
                $responses = Response::select('text')->whereIn('id', $input)->get()->pluck('text')->toArray();
                $existing->text_expanded = implode(", ", $responses);
                break;
            default:
        }
        $existing->save();

        return $existing;
    }

    public function getForQuestionArray(Collection $questions, int $student_id) :array
    {
        $question_ids = array();
        foreach ($questions as $question) {
            $question_ids[] = $question->id;
        }
        $answers = Answer::whereIn('question_id', $question_ids)->where('student_id', $student_id)->get();
        $answerArray = array();
        foreach ($answers as $answer) {
            $answerArray[$answer->question_id] = $answer;
        }

        return $answerArray;
    }

}
