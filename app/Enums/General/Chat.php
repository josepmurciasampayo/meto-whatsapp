<?php

namespace App\Enums\General;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Chat :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case CONFIRMIDENTITY = 1;
    case CONFIRMPERMISSION = 3;
    case ENDOFCYCLE = 5;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::CONFIRMIDENTITY => 'Confirm Identity',
            self::CONFIRMPERMISSION => 'Confirm Permission to Collect Info',
            self::ENDOFCYCLE => 'End of Application Cycle Survey',
        };
    }
}
