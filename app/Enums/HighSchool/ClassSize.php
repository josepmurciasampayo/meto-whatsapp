<?php

namespace App\Enums\HighSchool;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum ClassSize :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case TINY = 1;
    case SMALL = 2;
    case MEDIUM = 3;
    case LARGE = 4;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::TINY => 'Less than 10',
            self::SMALL => '11 - 50',
            self::MEDIUM => '51 - 100',
            self::LARGE => 'More than 100',
        };
    }
}
