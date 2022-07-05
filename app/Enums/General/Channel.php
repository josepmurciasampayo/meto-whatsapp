<?php

namespace App\Enums\General;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Channel :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case EMAIL = 1;
    case SMS = 2;
    case WHATSAPP = 3;
    case PHONE = 4;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::EMAIL => 'Email',
            self::SMS => 'SMS',
            self::WHATSAPP => 'WhatsApp',
            self::PHONE => 'Phone',
        };
    }
}
