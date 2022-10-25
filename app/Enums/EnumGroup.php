<?php

namespace App\Enums;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum EnumGroup: int
{
    use InvokableCases, Options, Values, Names, Strings;

    case CHAT_CAMPAIGNS = 1;
    case CHAT_STATE = 2;

    case COUNTRY = 3;
    case SUBREGION = 4;
    case REGION = 5;

    case GENERAL_CHANNEL = 6;
    case GENERAL_FORM = 7;
    case GENERAL_FORMSTATUS = 8;
    case GENERAL_LOGINEVENTTYPE = 26;
    case GENERAL_MATCH = 9;
    case GENERAL_METHOD = 10;
    case GENERAL_MONTH = 38;
    case GENERAL_QUESTIONTYPE = 27;
    case GENERAL_SOCIALNETWORK = 11;
    case GENERAL_SUBJECT = 39;
    case GENERAL_TAGGROUP = 12;

    case HS_BOARDING = 28;
    case HS_CLASSSIZE = 29;
    case HS_COST = 30;
    case HS_EXAM = 31;
    case HS_ROLE = 32;
    case HS_SCHOOLSIZE = 33;
    case HS_TYPE = 34;

    case INSTITUTION_TAG = 13;
    case INSTITUTION_ROLE = 35;
    case INSTITUTION_SIZE = 36;
    case INSTITUTION_TYPE = 14;

    case STUDENT_CURRICULUM = 15;
    case STUDENT_DISABILITY = 16;
    case STUDENT_GENDER = 17;
    case STUDENT_OWNER = 18;
    case STUDENT_QUESTION_TYPE = 37;
    case STUDENT_REFUGEE = 19;
    case STUDENT_SUBMISSION_DEVICE = 20;
    case STUDENT_TAG = 21;

    case USER_CONSENT = 22;
    case USER_ROLE = 23;
    case USER_STATUS = 24;
    case USER_VERIFIED = 25;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::CHAT_CAMPAIGNS => "",
            self::CHAT_STATE => "",

            self::COUNTRY => "",
            self::SUBREGION => "",
            self::REGION => "",

            self::GENERAL_CHANNEL => "",
            self::GENERAL_FORM => "",
            self::GENERAL_FORMSTATUS => "",
            self::GENERAL_MATCH => "",
            self::GENERAL_METHOD  => "",
            self::GENERAL_SOCIALNETWORK  => "",
            self::GENERAL_TAGGROUP  => "",
            self::GENERAL_LOGINEVENTTYPE => "",

            self::INSTITUTION_TAG  => "",
            self::INSTITUTION_TYPE  => "",

            self::STUDENT_CURRICULUM  => "",
            self::STUDENT_DISABILITY  => "",
            self::STUDENT_GENDER  => "",
            self::STUDENT_OWNER  => "",
            self::STUDENT_REFUGEE  => "",
            self::STUDENT_SUBMISSION_DEVICE  => "",
            self::STUDENT_TAG  => "",

            self::USER_CONSENT  => "",
            self::USER_ROLE  => "",
            self::USER_STATUS  => "",
            self::USER_VERIFIED  => "",
        };
    }

}
