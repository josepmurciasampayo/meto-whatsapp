<?php

namespace App\Enums\Country;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings, Metadata};

enum Region :int
{
    use InvokableCases, Options, Values, Names, Strings, Metadata;

    #[Description('Asia')]
    case ASIA = 1;

    #[Description('Europe')]
    case EUROPE = 2;

    #[Description('Africa')]
    case AFRICA = 3;

    #[Description('Oceania')]
    case OCEANIA = 4;

    #[Description('Americas')]
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

}
