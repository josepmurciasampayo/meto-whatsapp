<?php

namespace App\Enums\Country;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings, Metadata};

enum SubRegion :int
{
    use InvokableCases, Options, Values, Names, Strings, Metadata;

    #[Description('Southern Asia')]
    case SOUTHERNASIA = 5;

    #[Description('Northern Europe')]
    case NORTHERNEUROPE	= 6;

    #[Description('Southern Europe')]
    case SOUTHERNEUROPE	= 7;

    #[Description('Northern Africa')]
    case NORTHERNAFRICA	= 8;

    #[Description('Polynesia')]
    case POLYNESIA = 9;

    #[Description('Sub Saharan Africa')]
    case SUBSAHARANAFRICA = 10;

    #[Description('Latin America and the Caribbean')]
    case LATINAMERICAANDTHECARIBBEAN = 11;

    #[Description('Western Asia')]
    case WESTERNASIA = 12;

    #[Description('Australia and New Zealand')]
    case AUSTRALIAANDNEWZEALAND	= 13;

    #[Description('Western Europe')]
    case WESTERNEUROPE = 14;

    #[Description('Eastern Europe')]
    case EASTERNEUROPE = 15;

    #[Description('Northern American')]
    case NORTHERNAMERICA = 16;

    #[Description('Southeastern Asia')]
    case SOUTHEASTERNASIA = 17;

    #[Description('Eastern Asia')]
    case EASTERNASIA = 18;

    #[Description('Melanesia')]
    case MELANESIA = 19;

    #[Description('Micronesia')]
    case MICRONESIA = 20;

    #[Description('Central Asia')]
    case CENTRALASIA = 21;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::SOUTHERNASIA => "Southern Asia",
            self::NORTHERNEUROPE => "Northern Europe",
            self::SOUTHERNEUROPE => "Southern Europe",
            self::NORTHERNAFRICA => "Northern Africa",
            self::POLYNESIA => "Polynesia",
            self::SUBSAHARANAFRICA => "Sub-Saharan Africa",
            self::LATINAMERICAANDTHECARIBBEAN => "Latin America and the Caribbean",
            self::WESTERNASIA => "Western Asia",
            self::AUSTRALIAANDNEWZEALAND => "Australia and New Zealand",
            self::WESTERNEUROPE => "Western Europe",
            self::EASTERNEUROPE => "Eastern Europe",
            self::NORTHERNAMERICA => "Northern America",
            self::SOUTHEASTERNASIA => "Southeastern Asia",
            self::EASTERNASIA => "Eastern Asia",
            self::MELANESIA => "Melanesia",
            self::MICRONESIA => "Micronesia",
            self::CENTRALASIA => "Central Asia",
        };
    }

}
