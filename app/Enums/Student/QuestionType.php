<?php

namespace App\Enums\Student;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum QuestionType :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case NORMAL = 1;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::NORMAL => 'Normal',
        };
    }
}
