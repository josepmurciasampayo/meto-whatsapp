<?php

namespace App\Enums\Student;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Gender :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case MALE = 1;
    case FEMALE = 2;
    case OTHER = 3;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::MALE => "Male",
            self::FEMALE => "Female",
            self::OTHER => "Other",
            null => "",
        };
    }
}
