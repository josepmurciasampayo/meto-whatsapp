<?php

namespace App\Enums\Student;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Owner :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case MOM = 1;
    case DAD = 2;
    case SIBLING = 3;
    case OTHER = 4;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::MOM => "Mom",
            self::DAD => "Dad",
            self::SIBLING => "Sibling",
            self::OTHER => "Other",
        };
    }
}
