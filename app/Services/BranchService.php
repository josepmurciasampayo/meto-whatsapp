<?php

namespace App\Services;

use App\Models\Question;
use App\Models\ResponseBranch;
use Illuminate\Http\Request;

class BranchService
{
    public function store(Request $request, Question $question): void
    {
        if ($request->has('hasBranch')) {
            ResponseBranch::where('question_id', $question->id)->delete(); // remove all existing branches in order to add whatever is submitted
            if ($request->has('branchDestinations')) {
                foreach ($request->input('branchDestinations') as $response_id => $responseBranch) {
                    $branch = new ResponseBranch();
                    $branch->question_id = $question->id;
                    $branch->response_id = $response_id;
                    $branch->to_screen = $responseBranch;
                    $branch->save();
                }
            } else {
                foreach ($question->responses as $response) {
                    $branch = new ResponseBranch();
                    $branch->question_id = $question->id;
                    $branch->response_id = $response->id;
                    $branch->save();
                }
            }
        }
    }
}
