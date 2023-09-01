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
    case RWANFINALA1 = 12;
    case RWANFINALA2 = 54;
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
    case FINAL_AVERAGE= 27;
    case WASSCE_AVE= 28;
    case HIGH_SCHOOL_AVE= 29;
    case AVE_SCORE_SCALE_1= 30;
    case AVE_SCORE_SCALE_2= 31;
    case EXAME_NACIONAL= 32;
    case WASSCE_AVE2 = 33;
    case SEM_AVE= 34;
    case RECENT_GRADE= 35;
    case FINAL_GRADE= 36;
    case MATRIC_AGG= 37;
    case APS_AGG= 38;
    case APS_SCORE= 39;
    case HSC_ALIM_GPA= 40;
    case RECENT_GPA= 41;
    case THANAWEYA_AVE= 42;
    case CNISE_MARKS= 43;
    case FINAL_GRADE_SCALE_1= 44;
    case FINAL_GRADE_SCALE_2= 45;
    case SENIOR_SCORE= 46;
    case NATIONAL_EXAM= 47;
    case PREDICTED_EXAM= 48;
    case GRADE_12= 49;
    case CUM_GPA= 50;
    case SLCE_GRADE= 51;
    case SEE_RESULT= 52;
    case OVERALL_GPA= 53;

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
