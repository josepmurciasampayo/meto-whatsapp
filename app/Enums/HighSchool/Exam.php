<?php

namespace App\Enums\HighSchool;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Exam :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case ETHIOPIAN = 1;
    case RWANDAN = 2;
    case UGANDAN = 3;
    case SWAZILAND = 4;
    case TANZANIAN = 5;
    case ZIMBABWEAN = 6;
    case KENYAN = 7;
    case LESOTHO = 8;
    case WASSCE = 9;
    case CAMBRIDGE = 10;
    case OTHER = 11;
    case NONE = 12;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::ETHIOPIAN => "Ethiopian Exit Exam (EHCEE)",
            self::RWANDAN => "Rwandan A-Levels (RCE)",
            self::UGANDAN => "Ugandan A-Levels (UCE)",
            self::SWAZILAND => "Swaziland O-Levels (SGCSE)",
            self::TANZANIAN => "Tanzanian A-Levels (TCE)",
            self::ZIMBABWEAN => "Zimbabwean A-Levels (ZCE)",
            self::KENYAN => "Kenyan A-Levels (KCSE)",
            self::LESOTHO => "Lesotho O-Levels (OGCSE)",
            self::WASSCE => "WASSCE",
            self::CAMBRIDGE => "Cambridge A-Levels",
            self::OTHER => "Other",
            self::NONE => "None",
        };
    }
}
