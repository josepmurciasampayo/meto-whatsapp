<?php

namespace App\Enums\Student;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum SubmissionDevice :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case PHONE = 1;
    case COMPUTER = 2;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::PHONE => "Phone",
            self::COMPUTER => "Computer",
        };
    }
}
