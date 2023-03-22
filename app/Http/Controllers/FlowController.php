<?php

namespace App\Http\Controllers;

use App\Enums\Page;
use App\Enums\Student\Curriculum;
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
            Page::ACADEMIC() => route('student.financial'),
            Page::FINANCIAL() => route('student.extracurricular'),
            Page::EXTRA() => route('student.university'),
            Page::UNIPLAN() => route('student.testing'),
            Page::TESTING() => route('student.general'),
            Page::GENERAL() => route('student.home'),
        ];
        if (isset($flow[$request->input('page')])) {
            return $flow[$request->input('page')];
        }
        return route('student.home');
    }

    public static function nextScreen($curriculum): int
    {
        switch ($curriculum) {
            case Curriculum::AMERICAN():
                // Add any required logic here or pass a parameter to `getNextAmerican()`
                return self::getNextAmerican();
        }
    }

    public static function getNextAmerican($question)
    {
        switch ($question) {
                // Complete the case block with the required logic
        }
    }
}
