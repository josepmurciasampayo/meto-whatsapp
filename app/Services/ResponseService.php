<?php

namespace App\Services;

use App\Models\Question;
use App\Models\Response;
use App\Models\ResponseBranch;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ResponseService
{
    public function create(Question $question, Request $request): void
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
            ResponseBranch::where('question_id', $question->id)->delete(); // remove all existing branches in order to add whatever is submitted

            $responses = $request->input('response');
            foreach ($responses as $id => $r) {
                $response = Response::find($id);
                if ($response) {
                    $response->text = $r;
                    $response->save();
                }

                if ($request->input('responseBranch') && $request->input('responseBranch')[$id]) {
                    $rb = new ResponseBranch();
                    $rb->question_id = $question->id;
                    $rb->response_id = $id;
                    $rb->to_screen = $request->input('responseBranch')[$id];
                    $rb->save();
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

    public function getAllAsString(Question $question) : string
    {
        $toReturn = array();
        $responses = Response::where('question_id', $question->id);
        foreach ($responses as $response) {
            $toReturn[] = $response->text;
        }
        return implode('\n', $toReturn);
    }

}
