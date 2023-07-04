<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Response;
use App\Models\ResponseBranch;
use App\Services\BranchService;
use App\Services\QuestionService;
use App\Services\ResponseService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class QuestionController extends Controller
{
    public function index(): View
    {
        return view('question.index', [
            'questions' => Question::all(),
        ]);
    }

    public function create() :View
    {
        return view('question.show', [
            'question' => new Question(),
            'responses' => new \Illuminate\Database\Eloquent\Collection(),
            'branches' => new \Illuminate\Database\Eloquent\Collection(),
        ]);
    }

    public function show(int $id = null) :View
    {
        $question = ($id) ? Question::with('academic')->find($id) : new Question();
        $responses = ($id) ? Response::where('question_id', $id)->get() : null;
        $branches = ($id) ? ResponseBranch::with('response')->where('question_id', $id)->get() : null;

        return view('question.show', [
            'question' => $question,
            'responses' => $responses,
            'branches' => $branches,
        ]);
    }

    public function store(Request $request, QuestionService $questionService, ResponseService $responseService, BranchService $branchService) :RedirectResponse
    {
        if (is_numeric($request->input('question_id'))) {
            $question = Question::with('responses')->find($request->input('question_id'));
        } else {
            $question = new Question();
            $question->save();
        }

        $questionService->store($request, $question);
        $responseService->store($request, $question);
        $branchService->store($request, $question);

        return redirect(route('questions.show', ['question' => $question->id]));
    }
}
