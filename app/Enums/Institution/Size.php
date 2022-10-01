<?php

namespace App\Enums\Institution;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Size: int
{
    use InvokableCases, Options, Values, Names, Strings;

    case SMALL = 1;
    case MID = 2;
    case LARGE = 3;
    case OTHER = 4;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::SMALL => "Small",
            self::MID => "Mid-sized",
            self::LARGE => "Large",
            self::OTHER => "Other",
        };
    }

}
