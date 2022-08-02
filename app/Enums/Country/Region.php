<?php

namespace App\Enums\Country;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Region :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case ASIA = 1;
    case EUROPE = 2;
    case AFRICA = 3;
    case OCEANIA = 4;
    case AMERICAS = 5;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::ASIA => "Asia",
            self::EUROPE => "Europe",
            self::AFRICA => "Africa",
            self::OCEANIA => "Oceania",
            self::AMERICAS => "Americas",
        };
    }

    public static function lookup(string $name) :Region
    {
        return match($name) {
            "Asia" => self::ASIA,
            "Europe" => self::EUROPE,
            "Africa" => self::AFRICA,
            "Oceania" => self::OCEANIA,
            "Americas" => self::AMERICAS,
        };
    }

}
