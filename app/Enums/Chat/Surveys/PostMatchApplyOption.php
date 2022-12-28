<?php

namespace App\Enums\Chat\Surveys;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum PostMatchApplyOption :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case ACADEMICRANKING = 1;
    case INTERNATIONAL = 2;
    case COURSES = 3;
    case SCHOLARSHIP = 4;
    case OTHER = 5;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::ACADEMICRANKING => "Academic ranking",
            self::INTERNATIONAL => "International student body",
            self::COURSES => "Courses offered",
            self::SCHOLARSHIP => "Scholarship opportunities",
            self::OTHER => "Other",

        };
    }
}
