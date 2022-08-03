<?php

namespace App\Enums\Chat;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Campaign :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case CONFIRMIDENTITY = 1;
    case CONFIRMPERMISSION = 2;
    case ENDOFCYCLE = 3;
    case UNKNOWNUSER = 4;
    case UNKNOWNMESSAGE = 5;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::CONFIRMIDENTITY => 'Confirm Identity',
            self::CONFIRMPERMISSION => 'Confirm Permission to Collect Info',
            self::ENDOFCYCLE => 'End of Application Cycle Survey',
            self::UNKNOWNUSER => 'Unknown User Response',
            self::UNKNOWNMESSAGE => 'Unknown Message Response',
        };
    }
}
