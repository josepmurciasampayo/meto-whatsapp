<?php

namespace App\Enums;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum ScoreType :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case IBFINAL = 1;
    case IBPREDICTED = 2;
    case IBSEMESTER = 3;
    case CAMFINAL = 4;
    case CAMPREDICTED = 5;
    case CAMAS = 6;
    case CAMJUNIOR = 7;
    case AMSENIORW = 8;
    case AMSENIORU = 9;
    case AMJUNIORW = 10;
    case AMJUNIORU = 11;
    case RWANFINALA = 12;
    case RWANMOCKA = 13;
    case RWANFINALON = 14;
    case RWANFINALOO = 15;
    case KENFINAL = 16;
    case KENMOCK = 17;
    case KENAGG = 18;
    case KENKCPE = 19;
    case UGANFINALA = 20;
    case UGANMOCK = 21;
    case UGANFINALO = 22;
    case OTHERLEAVING = 23;
    case OTHERPREVIOUS = 24;
    case IBUNI = 25;
    case CAMUNI = 26;

    public static function getText(self $value) :string
    {
        return match ($value) {
            self::IBFINAL => "",
            self::IBPREDICTED => "",
            self::IBSEMESTER => "",
            self::CAMFINAL => "",
            self::CAMPREDICTED => "",
            self::CAMAS => "",
            self::CAMJUNIOR => "",
            self::AMSENIORW => "",
            self::AMSENIORU => "",
            self::AMJUNIORW => "",
            self::AMJUNIORU => "",
            self::RWANFINALA => "",
            self::RWANMOCKA => "",
            self::RWANFINALON => "",
            self::RWANFINALOO => "",
            self::KENFINAL => "",
            self::KENMOCK => "",
            self::KENAGG => "",
            self::KENKCPE => "",
            self::UGANFINALA => "",
            self::UGANMOCK => "",
            self::UGANFINALO => "",
            self::OTHERLEAVING => "",
            self::OTHERPREVIOUS => "",
            self::IBUNI => "",
        };
    }
}
