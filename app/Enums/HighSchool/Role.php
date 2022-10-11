<?php

namespace App\Enums\HighSchool;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Role :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case STUDENT = 1;
    case COUNSELOR = 2;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::STUDENT => 'Student',
            self::COUNSELOR => 'Counselor',
        };
    }
}
