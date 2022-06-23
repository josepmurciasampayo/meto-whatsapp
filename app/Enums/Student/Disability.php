<?php

namespace App\Enums\Student;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Disability :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case NO = 1;
    case PARTIAL = 2;
    case FULL = 3;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::NO => "No",
            self::PARTIAL => "Partial",
            self::FULL => "Full",
        };
    }
}
