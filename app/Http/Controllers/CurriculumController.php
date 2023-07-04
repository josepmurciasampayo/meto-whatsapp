<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Services\QuestionService;
use Illuminate\View\View;

class CurriculumController extends Controller
{
    public function index() :View
    {
        return view('curriculum.index', [
            'curricula' => Curriculum::orderBy('name')->get(),
        ]);
    }

    public function show(int $curriculum_id, QuestionService $questionService) :View
    {
        $questions = $questionService->getAcademic($curriculum_id); // get all questions for curriculum and fill in text, format

        return view('curriculum.show', [
            'questions' => $questions,
            'curriculum' => Curriculum::find($curriculum_id),
        ]);
    }

    public function create(): View
    {
        return view('curriculum.create');
    }
}
