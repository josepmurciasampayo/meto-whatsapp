<?php

namespace App\Enums\General;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum HighSchoolRole :int
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
