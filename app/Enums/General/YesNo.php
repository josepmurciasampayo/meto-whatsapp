<?php

namespace App\Enums\General;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum YesNo :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case YES = 1;
    case NO = 2;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::YES => 'Yes',
            self::NO => 'No',
        };
    }
}
