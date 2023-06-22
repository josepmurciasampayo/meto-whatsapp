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
        if ($request->input('page') == Page::ACADEMIC()) {
            if ($request->input('screen') == 1 && $request->input('direction') == -1) {
                return route('student.highschool');
            }
            return self::nextAcademic($request);
        }

        $flow = [
            Page::GETSTARTED() => route('student.profile'),
            Page::PROFILE() => route('student.demographic'),
            Page::DEMO() => route('student.highschool'),
            Page::HIGHSCHOOL() => route('student.academics', ['screen' => 0]),
            Page::FINANCIAL() => route('student.extracurricular'),
            Page::EXTRA() => route('student.university'),
            Page::UNIPLAN() => route('student.testing'),
            Page::TESTING() => route('student.general'),
            Page::GENERAL() => route('student.home'),
        ];

        $reverseFlow = [
            Page::GETSTARTED() => route('home'),
            Page::PROFILE() => route('student.profile'),
            Page::DEMO() => route('student.profile'),
            Page::HIGHSCHOOL() => route('student.demographic'),
            Page::FINANCIAL() => route('student.academics', ['screen' => 0]),
            Page::EXTRA() => route('student.financial'),
            Page::UNIPLAN() => route('student.extracurricular'),
            Page::TESTING() => route('student.university'),
            Page::GENERAL() => route('student.testing'),
        ];

        if (isset($flow[$request->input('page')])) {
            switch($request->input('direction')) {
                case 1: return $flow[$request->input('page')];
                case -1: return $reverseFlow[$request->input('page')];
                case -3: return route('home');
            };
        }

        return route('home');
    }

    public static function nextAcademic(Request $request) :string
    {
        $curriculum = $request->input('curriculum');
        $screen = $request->input('screen');


        $nextScreen = (new QuestionService())->getAcademicNextScreen($curriculum, $screen);
        if ($nextScreen == 0) {
            return route('student.financial');
        }
        else return route('student.academics', ['screen' => $nextScreen]);
    }
}
