<?php

namespace App\Enums\Student;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Consent :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case NOCONSENT = 6;
    case CONSENT = 7;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::NOCONSENT => "No Consent",
            self::CONSENT => "Consent",
        };
    }

}
