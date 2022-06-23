<?php

namespace App\Enums\General;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Method :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case NORMAL = 1;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::NORMAL => 'Normal',
        };
    }
}
