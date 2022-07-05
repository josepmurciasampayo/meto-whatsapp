<?php

namespace App\Enums\General;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum StudentInstitutionMatch :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case INITIATED = 1;
    case MATCHED = 3;
    case APPLIED = 5;
    case DENIED = 5;
    case ACCEPTED = 7;
    case ENROLLED = 8;


    public static function getText(self $value) :string
    {
        return match($value) {
            self::CONFIRMIDENTITY => 'Confirm Identity',
            self::CONFIRMPERMISSION => 'Confirm Permission to Collect Info',
            self::ENDOFCYCLE => 'End of Application Cycle Survey',
        };
    }
}
