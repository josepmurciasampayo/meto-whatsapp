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
    case OTHER = 8;
    case NATIONAL = 9;
    case INDIA = 10;
    case VIETNAM = 11;
    case GHANA = 12;
    case MEXICO = 13;
    case NIGERIA = 14;
    case ETHIOPIA = 15;
    case NEPAL = 16;
    case SAUDIARABIA = 17;
    case IRAN = 18;
    case KUWAIT = 19;
    case TURKIYE = 20;
    case BANGLADESH = 21;
    case BRAZIL = 22;
    case INDONESIA = 23;
    case SOUTHAFRICA = 24;
    case MOROCCO = 25;
    case EGYPT = 26;

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
            self::OTHER => "All Others",
            self::NATIONAL => "National",
            self::INDIA => 'Indian',
            self::VIETNAM => 'Vietnamese',
            self::GHANA => 'Ghanian',
            self::MEXICO => 'Mexican',
            self::NIGERIA => 'Nigerian',
            self::ETHIOPIA => 'Ehtiopian',
            self::NEPAL => 'Nepalese',
            self::SAUDIARABIA => 'Saudi Arabian',
            self::IRAN => 'Iranian',
            self::KUWAIT => 'Kuwaiti',
            self::TURKIYE => 'Turkish',
            self::BANGLADESH => 'Bangladeshi',
            self::BRAZIL => 'Brazillian',
            self::INDONESIA => 'Indonesian',
            self::SOUTHAFRICA => 'South Africa',
            self::MOROCCO => 'Moroccan',
            self::EGYPT => 'Egyptian',
        };
    }

    public static function getSchoolChoices() :array
    {
        return [
            self::NATIONAL() => "National",
            self::IB() => "IB",
            self::CAMBRIDGE() => "Cambridge",
            self::AMERICAN() => "American",
            self::OTHER() => "Other",
        ];
    }

    public function labelPowergridFilter(): string
    {
        return self::getText($this);
    }
}
