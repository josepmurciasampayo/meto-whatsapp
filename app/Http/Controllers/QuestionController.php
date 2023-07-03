<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Response;
use App\Services\QuestionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuestionController extends Controller
{
    public function show(int $id = null) :View
    {
        $question = ($id) ? Question::with('academic')->find($id) : new Question();
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
