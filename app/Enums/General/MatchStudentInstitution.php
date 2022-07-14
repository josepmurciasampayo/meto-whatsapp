<?php

namespace App\Enums\General;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum MatchStudentInstitution :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case INITIATED = 1;
    case MATCHED = 2;
    case APPLIED = 3;
    case DENIED = 4;
    case ACCEPTED = 5;
    case ENROLLED = 6;
    case UNKNOWN = 7;


    public static function getText(self $value) :string
    {
        return match($value) {
            self::INITIATED => 'Initiated',
            self::MATCHED => 'Matched',
            self::APPLIED => 'Applied',
            self::DENIED => 'Denied',
            self::ACCEPTED => 'Accepted',
            self::ENROLLED => 'Enrolled',
            self::UNKNOWN => 'Unknown',
        };
    }
}
