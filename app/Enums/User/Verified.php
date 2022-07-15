<?php

namespace App\Enums\User;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Verified :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case UNKNOWN = 1;
    case DENIED = 2;
    case VERIFIED = 3;

    public static function getText(self $value) :string
    {
        return match ($value) {
            self::UNKNOWN => "Unknown",
            self::DENIED => "Denied",
            self::VERIFIED => "Verified",
        };
    }
}
