<?php

namespace App\Enums\HighSchool;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Cost :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case ONE = 1;
    case TWO = 2;
    case THREE = 3;
    case FOUR = 4;
    case FIVE = 5;
    case SIX = 6;
    case SEVEN = 7;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::ONE => "Less than $5,000",
            self::TWO => "$5,001 - $10,000",
            self::THREE => "$10,001 - $15,000",
            self::FOUR => "$15,001 -$20,000",
            self::FIVE => "$20,001 - $30,000",
            self::SIX => "$30,001 - $40,000",
            self::SEVEN => "More than $40,000",
        };
    }
}
