<?php

namespace App\Enums\Student;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Curriculum :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case KENYAN = 1;
    case UGANDAN = 2;
    case RWANDAN = 3;
    case AMERICAN = 4;
    case IB = 5;
    case CAMBRIDGE = 6;
    case TRANSFER = 7;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::KENYAN => "Kenyan",
            self::UGANDAN => "Ugandan",
            self::RWANDAN => "Rwandan",
            self::AMERICAN => "American",
            self::IB => "IB",
            self::CAMBRIDGE => "Cambridge",
            self::TRANSFER => "Graduates and Transfers",
        };
    }
}
