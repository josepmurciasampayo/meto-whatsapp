<?php

namespace App\Enums\Student;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Verified :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case DENIED = 5;
    case VERIFIED = 6;

    public static function getText(self $value) :string
    {
        return match ($value) {
            self::DENIED => "Denied",
            self::VERIFIED => "Verified",
        };
    }
}
