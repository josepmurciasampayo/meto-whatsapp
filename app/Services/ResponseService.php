<?php

namespace App\Services;

use App\Models\Question;
use App\Models\Response;
use App\Models\ResponseBranch;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ResponseService
{
    public function store(Request $request, Question $question): void
    {
        // first, check if we are creating a number of blank responses
        if ($request->input('responses')) { // number of responses to create
            $responses = $request->input('responses');
            for ($i = 0; $i < $responses; ++$i) {
                $response = new Response();
                $response->question_id = $question->id;
                $response->save();
            }
            return;
        }

        // second, check if we are creating set responses from the textarea
        if ($request->input('responsesList')) {
            if ($request->input('deleteResponses')) {
                Response::where('question_id', $question->id)->delete();
            }
            $responses = preg_split("/\r\n|\n|\r/", $request->input('responsesList'));
            foreach ($responses as $response) {
                $r = new Response();
                $r->question_id = $question->id;
                $r->text = $response;
                $r->save();
            }
            return;
        }

        // finally, review each submitted response
        if ($request->input('response')) { // text for existing responses
            foreach ($request->input('response') as $id => $r) {
                $response = Response::find($id);
                if ($response) {
                    $response->text = $r;
                    $response->order = intval($request->get('orders')[$response->id]);
                    $response->save();
                }
            }
        }
    }

    public function getForQuestionArray(Collection $questions) :array
    {
        $question_ids = array();
        foreach ($questions as $id => $question) {
            $question_ids[] = $id;
        }
        $responses = Response::whereIn('question_id', $question_ids)->get();
        $responseArray = array();
        foreach ($responses as $response) {
            $responseArray[$response->question_id][] = $response;
        }
        return $responseArray;
    }

}
