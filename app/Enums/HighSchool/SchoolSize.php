<?php

namespace App\Enums\HighSchool;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum SchoolSize :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case TINY = 1;
    case SMALL = 2;
    case MEDIUM = 3;
    case LARGE = 4;
    case EXTRALARGE = 5;
    case HUGE = 6;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::TINY => 'Less than 500',
            self::SMALL => '501 to 1000',
            self::MEDIUM => '1001 - 1500',
            self::LARGE => '1501 - 2000',
            self::EXTRALARGE => '2001 - 2500',
            self::HUGE => 'More than 2500',
        };
    }
}
