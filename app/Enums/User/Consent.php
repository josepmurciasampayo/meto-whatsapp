<?php

namespace App\Enums\User;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Consent :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case UNKNOWN = 1;
    case NOCONSENT = 2;
    case CONSENT = 3;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::UNKNOWN => "Unknown",
            self::NOCONSENT => "No Consent",
            self::CONSENT => "Consent",
        };
    }

}
