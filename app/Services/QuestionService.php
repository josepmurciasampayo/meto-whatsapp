<?php

namespace App\Services;

use App\Enums\General\YesNo;
use App\Enums\QuestionStatus;
use App\Enums\Student\QuestionType;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;


class QuestionService
{
    public function get(QuestionType $type) :array
    {
        $questions = Question::
            where('type', $type())
            ->where('status', QuestionStatus::ACTIVE())
            ->orderBy('order', 'asc')
            ->get();

        $toReturn = array();
        foreach ($questions as $question) {
            $toReturn[$question->id] = $question;
        }
        return $toReturn;
    }

    public function store(Request $request) :Question
    {
        if ($request->input('toDelete') > 0) {
            Response::destroy($request->input('toDelete'));
            return Question::find($request->input('question_id'));
        }

        $question = Question::find($request->input('question_id'));
        $question->text = $request->input('text');
        $question->format = $request->input('format');
        $question->type = $request->input('category');
        $question->order = $request->input('order');
        $question->required = match($request->input('required')) {
            'Yes' => YesNo::YES(),
            'No' => YesNo::NO(),
        };
        $question->status = match($request->input('active')) {
            'Active' => QuestionStatus::ACTIVE(),
            'Inactive' => QuestionStatus::INACTIVE(),
        };
        $question->save();

        if ($request->input('responses')) { // number of responses to create
            $responses = $request->input('responses');
            for ($i = 0; $i < $responses; ++$i) {
                $response = new Response();
                $response->question_id = $question->id;
                $response->save();
            }
        }

        if ($request->input('response')) { // text for existing responses
            $responses = $request->input('response');
            foreach ($responses as $id => $r) {
                $response = Response::find($id);
                $response->text = $r;
                $response->save();
            }
        }
        return $question;
    }

    public function responses(array $questions) :array
    {
        $question_ids = array();
        foreach ($questions as $question) {
            $question_ids[] = $question->id;
        }
        $responses = Response::whereIn('question_id', $question_ids)->get();
        $responseArray = array();
        foreach ($responses as $response) {
            $responseArray[$response->question_id][] = $response;
        }
        return $responseArray;
    }
}
