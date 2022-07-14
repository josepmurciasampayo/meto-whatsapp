<?php

namespace App\Enums\Student;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Verified :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case UNKNOWN = 12;
    case DENIED = 5;
    case VERIFIED = 6;

    public static function getText(self $value) :string
    {
        return match ($value) {
            self::UNKNOWN => "Unknown",
            self::DENIED => "Denied",
            self::VERIFIED => "Verified",
        };
    }
}
