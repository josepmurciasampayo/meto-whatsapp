<?php

namespace App\Http\Controllers;

use App\Enums\Page;
use App\Enums\Student\Curriculum;
use App\Services\QuestionService;
use Illuminate\Http\Request;

class FlowController extends Controller
{
    public static function next(Request $request): string
    {
        $flow = [
            Page::GETSTARTED() => route('student.intro'),
            Page::INTRO() => route('student.profile'),
            Page::PROFILE() => route('student.demographic'),
            Page::DEMO() => route('student.highschool'),
            Page::HIGHSCHOOL() => route('student.academics'),
            Page::FINANCIAL() => route('student.extracurricular'),
            Page::EXTRA() => route('student.university'),
            Page::UNIPLAN() => route('student.testing'),
            Page::TESTING() => route('student.general'),
            Page::GENERAL() => route('student.home'),
            Page::ACADEMIC() => self::nextAcademic($request),
        ];

        if (isset($flow[$request->input('page')])) {
            return $flow[$request->input('page')];
        }

        return route('student.home');
    }

    public static function nextAcademic(Request $request) :string
    {
        $curriculum = $request->input('curriculum');
        $screen = $request->input('screen');

        $nextScreen = (new QuestionService())->getAcademicNextScreen($curriculum, $screen);
        if ($nextScreen == 0) {
            return route('student.financial');
        }
        else return route('student.academic', ['screen' => $screen, 'curriculum' => $curriculum]);
    }
}
