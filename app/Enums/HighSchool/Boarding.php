<?php

namespace App\Enums\HighSchool;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Boarding :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case YES = 1;
    case NO = 2;
    case MIXED = 3;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::YES => 'Yes',
            self::NO => 'No',
            self::MIXED => 'Mixed',
        };
    }
}
