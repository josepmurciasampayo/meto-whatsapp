<?php

namespace App\Enums;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum EnumGroup: int
{
    use InvokableCases, Options, Values, Names, Strings;

    case GENERAL_CHANNEL = 1;
    case GENERAL_CHAT = 2;
    case GENERAL_FORMSTATUS = 3;
    case GENERAL_MESSAGESTATE = 4;
    case GENERAL_METHOD = 5;
    case GENERAL_SOCIALNETWORK = 6;
    case GENERAL_MATCH = 7;
    case GENERAL_TAGGROUP = 8;


    case USER_ROLE = 9;
    case USER_STATUS = 10;
    case USER_CONSENT = 11;
    case USER_VERIFIED = 12;

    case STUDENT = 18;

    case INSTITUTION = 13;

    case MATCH = 14;

    case COUNTRY = 15;

    case SUBREGION = 16;

    case REGION = 17;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::GENERAL_CHANNEL => "Administrator",
            self::GENERAL_CHAT => "Student",
            self::GENERAL_FORMSTATUS => "Institution",
            self::GENERAL_MESSAGESTATE => "Privacy Terms",
        };
    }
}
