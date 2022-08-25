<?php

namespace App\Enums\User;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Role: int
{
    use InvokableCases, Options, Values, Names, Strings;

    case ADMIN = 1;
    case STUDENT = 2;
    case INSTITUTION = 3;
    case COUNSELOR = 4;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::ADMIN => "Administrator",
            self::STUDENT => "Student",
            self::INSTITUTION => "Institution",
            self::COUNSELOR => "Counselor",
        };
    }

}
