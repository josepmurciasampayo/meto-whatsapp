<?php

namespace App\Enums\General;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum FormStatus :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case CREATED = 1;
    case SENT = 2;
    case RESPONDED = 3;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::CREATED => 'Created',
            self::SENT => 'Sent',
            self::RESPONDED => 'Responded',
        };
    }
}
