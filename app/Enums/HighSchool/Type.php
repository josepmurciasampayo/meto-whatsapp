<?php

namespace App\Enums\HighSchool;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Type :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case PUBLIC = 1;
    case PRIVATE = 2;
    case ACCESS = 3;
    case OTHER = 4;
    case UNKNOWN = 5;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::PUBLIC => 'Public',
            self::PRIVATE => 'Private',
            self::ACCESS => 'College Access Program',
            self::OTHER => 'Other',
            self::UNKNOWN => 'Unknown',
        };
    }
}
