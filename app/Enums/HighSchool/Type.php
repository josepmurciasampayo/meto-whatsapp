<?php

namespace App\Enums\HighSchool;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Type :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case PUBLIC = 1;
    case PRIVATE = 2;
    case REFUGEE = 3;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::PUBLIC => 'Public',
            self::PRIVATE => 'Private',
            self::REFUGEE => 'Refugee'
        };
    }
}
