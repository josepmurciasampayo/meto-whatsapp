<?php

namespace App\Http\Controllers;

use App\Enums\Student\QuestionType;
use App\Models\Question;
use App\Models\QuestionCurriculum;
use App\Models\Response;
use App\Models\ResponseBranch;
use App\Services\QuestionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuestionController extends Controller
{
    public function index(): View
    {
        return view('question.index', [
            'data' => (new QuestionService())->getAdminData(),
        ]);
    }

    public function show(int $id = null) :View
    {
        $question = ($id) ? Question::with('academic.curriculum')->find($id) : new Question();
        $responses = ($id) ? Response::where('question_id', $id)->get() : null;

        return view('question.show', [
            'question' => $question,
            'responses' => $responses,
        ]);
    }

    public function store(Request $request, QuestionService $questionService) :RedirectResponse
    {
        $question = $questionService->store($request);
        return redirect(route('questions.show', ['question' => $question->id]));
    }
}
