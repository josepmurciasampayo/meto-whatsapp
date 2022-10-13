<?php

namespace App\Enums\Institution;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Role :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case ADMIN = 1;
    case OFFICER = 2;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::ADMIN => 'Administrator',
            self::OFFICER => 'Admissions Officer',
        };
    }
}
