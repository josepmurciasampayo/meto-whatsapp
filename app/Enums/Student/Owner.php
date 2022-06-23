<?php

namespace App\Enums\Student;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Owner :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case SELF = 8;
    case PARENT = 9;
    case GUARDIAN = 10;
    case OTHER = 11;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::SELF => "Self",
            self::PARENT => "Parent",
            self::GUARDIAN => "Guardian",
            self::OTHER => "Other",
        };
    }
}
