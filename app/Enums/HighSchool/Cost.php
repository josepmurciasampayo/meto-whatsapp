<?php

namespace App\Enums\HighSchool;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Cost :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case SMALL = 1;
    case MEDIUM = 2;
    case LARGE = 3;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::SMALL => 'Less than $500',
            self::MEDIUM => '$501 to $1000',
            self::LARGE => 'More than $1000'
        };
    }
}
