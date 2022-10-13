<?php

namespace App\Enums\General;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Month :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case JANUARY = 1;
    case FEBRUARY = 2;
    case MARCH = 3;
    case APRIL = 4;
    case MAY = 5;
    case JUNE = 6;
    case JULY = 7;
    case AUGUST = 8;
    case SEPTEMBER = 9;
    case OCTOBER = 10;
    case NOVEMBER = 11;
    case DECEMBER = 12;


    public static function getText(self $value) :string
    {
        return match($value) {
            self::JANUARY => "January",
            self::FEBRUARY => "February",
            self::MARCH => "March",
            self::APRIL => "April",
            self::MAY => "May",
            self::JUNE => "June",
            self::JULY => "July",
            self::AUGUST => "August",
            self::SEPTEMBER => "September",
            self::OCTOBER => "October",
            self::NOVEMBER => "November",
            self::DECEMBER => "December",
        };
    }
}
