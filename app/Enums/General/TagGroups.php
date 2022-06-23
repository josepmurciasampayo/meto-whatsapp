<?php

namespace App\Enums\General;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum TagGroups: int
{
    use InvokableCases, Options, Values, Names, Strings;

    case ADMIN = 1;
    case STUDENT = 2;
    case INSTITUTION = 3;
    case PRIVACYTERMS = 4;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::ADMIN => "Administrator",
            self::STUDENT => "Student",
            self::INSTITUTION => "Institution",
            self::PRIVACYTERMS => "Privacy Terms",
        };
    }

}
