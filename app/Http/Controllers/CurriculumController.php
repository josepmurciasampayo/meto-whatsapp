<?php

namespace App\Http\Controllers;


use App\Enums\General\YesNo;
use App\Enums\QuestionFormat;
use App\Models\Curriculum;
use App\Models\QuestionCurriculum;
use App\Models\ResponseBranch;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CurriculumController extends Controller
{
    public function index() :View
    {
        return view('curriculum.index', [
            'curricula' => Curriculum::all(),
        ]);
    }

    public function show(int $curriculum, QuestionService $questionService) :View
    {
        $questions = $screens = array(); // arrays to be filled and sent to the view

        $q = $questionService->getAcademic($curriculum); // get all questions for curriculum and fill in text, format
        foreach ($q as $id => $question) {
            $questions[$id]['text'] = $question['text'];
            $questions[$id]['format'] = QuestionFormat::descriptions()[$question['format']];
        }

        $s = QuestionCurriculum::where('curriculum', $curriculum)->get(); // get all

        foreach ($s as $screen) {
            $questions[$screen->question_id]['screen'] = $screen->screen;
            $questions[$screen->question_id]['order'] = $screen->order;
            $questions[$screen->question_id]['destination'] = $screen->destination_screen ?? false;

            $screens[$screen->screen] = ($screen->branch == YesNo::YES()) || !is_null($screen->destination_screen) || (isset($screens[$screen->screen]) && $screens[$screen->screen]);

            $b = ResponseBranch::where('curriculum', $curriculum)->where('question_id', $screen->question_id)->get();
            if (count($b) > 0) {
                $questions[$screen->question_id]['branch'] = array();
                foreach ($b as $branch) {
                    $questions[$branch->question_id]['branch'][] = $branch->to_screen;
                }
                $branches = array_unique($questions[$branch->question_id]['branch']);
                $questions[$branch->question_id]['branch'] = implode(',', $branches);
            } else {
                $questions[$screen->question_id]['branch'] = null;
            }
        }

        return view('curriculum.show', [
            'questions' => $questions,
            'screens' => $screens,
            'curriculum' => \App\Enums\Student\Curriculum::descriptions()[$curriculum],
        ]);
    }

    public function create(): View
    {
        return view('curriculum.create');
    }
}
