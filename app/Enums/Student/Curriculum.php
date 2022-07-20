<?php

namespace App\Enums\Student;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Curriculum :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case RWANDAN = 1;
    case TWO = 2;


    public static function getText(self $value) :string
    {
        return match($value) {
            self::RWANDAN => "Rwandan",
            self::TWO => "Female",

        };
    }
}
