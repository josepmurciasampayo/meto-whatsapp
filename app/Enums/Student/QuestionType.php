<?php

namespace App\Enums\Student;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum QuestionType :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case DEMOGRAPHIC = 1;
    case ACADEMIC = 2;
    case FINANCIAL = 3;
    case EXTRACURRICULAR = 4;
    case UNIVERSITY = 5;
    case GENERAL = 6;
    case TESTING = 7;
    case HIGHSCHOOL = 8;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::DEMOGRAPHIC => "Demographic",
            self::ACADEMIC => "Academic",
            self::FINANCIAL => "Financial",
            self::EXTRACURRICULAR => "Extracurricular",
            self::UNIVERSITY => "University",
            self::GENERAL => "General",
            self::TESTING => "Testing",
            self::HIGHSCHOOL => "High School",
        };
    }
}
