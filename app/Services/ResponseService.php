<?php

namespace App\Services;

use App\Models\Question;
use App\Models\Response;
use App\Models\ResponseBranch;
use Illuminate\Http\Request;

class ResponseService
{
    public function create(Question $question, Request $request): void
    {
        if ($request->input('responses')) { // number of responses to create
            $responses = $request->input('responses');
            for ($i = 0; $i < $responses; ++$i) {
                $response = new Response();
                $response->question_id = $question->id;
                $response->save();
            }
        }

        if ($request->input('responsesList')) {
            $responses = preg_split("/\r\n|\n|\r/", $request->input('responsesList'));
            foreach ($responses as $response) {
                $r = new Response();
                $r->question_id = $question->id;
                $r->text = $response;
                $r->save();
            }
        }

        if ($request->input('response')) { // text for existing responses
            ResponseBranch::where('question_id', $question->id)->delete();

            $responses = $request->input('response');
            foreach ($responses as $id => $r) {
                $response = Response::find($id);
                $response->text = $r;
                $response->save();

                if ($request->input('responseBranch') && $request->input('responseBranch')[$id]) {
                    foreach ($request->input('responseBranch')[$id] as $curriculum => $value) {
                        $rb = new ResponseBranch();
                        $rb->question_id = $question->id;
                        $rb->response_id = $id;
                        $rb->curriculum = $curriculum;
                        $rb->to_screen = $value;
                        $rb->save();
                    }
                }
            }
        }
    }

}
