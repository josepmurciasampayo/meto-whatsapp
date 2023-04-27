<?php

namespace App\Enums\Student;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum PhoneOwner :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case MINE = 1;
    case MOM = 2;
    case DAD = 3;
    case RELATIVE = 4;
    case TEACHER = 5;
    case OTHER = 6;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::MINE => "It is mine",
            self::MOM => "My mother",
            self::DAD => "My father",
            self::RELATIVE => "Another relative",
            self::TEACHER => "A teacher",
            self::OTHER => "Other",
        };
    }
}
