<?php

namespace App\Enums\Country;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum SubRegion :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case SOUTHERNASIA = 1;
    case NORTHERNEUROPE	= 2;
    case SOUTHERNEUROPE	= 3;
    case NORTHERNAFRICA	= 4;
    case POLYNESIA = 5;
    case SUBSAHARANAFRICA = 6;
    case LATINAMERICAANDTHECARIBBEAN = 7;
    case WESTERNASIA = 8;
    case AUSTRALIAANDNEWZEALAND	= 9;
    case WESTERNEUROPE = 10;
    case EASTERNEUROPE = 11;
    case NORTHERNAMERICA = 12;
    case SOUTHEASTERNASIA = 13;
    case EASTERNASIA = 14;
    case MELANESIA = 15;
    case MICRONESIA = 16;
    case CENTRALASIA = 17;

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

    public static function lookup(string $name) :SubRegion
    {
         return match($name) {
             "Southern Asia" => self::SOUTHERNASIA,
             "Northern Europe" => self::NORTHERNEUROPE,
             "Southern Europe" => self::SOUTHERNEUROPE,
             "Northern Africa" => self::NORTHERNAFRICA,
             "Polynesia" => self::POLYNESIA,
             "SubSaharan Africa" => self::SUBSAHARANAFRICA,
             "Latin America and the Caribbean" => self::LATINAMERICAANDTHECARIBBEAN,
             "Western Asia" => self::WESTERNASIA,
             "Australia and New Zealand" => self::AUSTRALIAANDNEWZEALAND,
             "Western Europe" => self::WESTERNEUROPE,
             "Eastern Europe" => self::EASTERNEUROPE,
             "Northern America" => self::NORTHERNAMERICA,
             "Southeastern Asia" => self::SOUTHEASTERNASIA,
             "Eastern Asia" => self::EASTERNASIA,
             "Melanesia" => self::MELANESIA,
             "Micronesia" => self::MICRONESIA,
             "Central Asia" => self::CENTRALASIA,
         };
    }

}
