<?php

namespace App\Enums;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum QuestionFormat: int

{
    use InvokableCases, Options, Values, Names, Strings;

    case NOTSET = 0;
    case INPUT = 1;
    case SELECT = 3;
    case RADIO = 4;
    case TEXTAREA = 5;
    case CHECKBOX = 6;
    case DATE = 7; // Added this line for the date input
    case COUNTRY = 8; // Added this line for the COUNTRY input
    case COUNTRY_CHECKBOX = 9; // Added this line for the COUNTRY_CHECKBOX input
    case EMAIL = 10; // Added this line for the EMAIL input
    case PHONE = 11; // Added this line for the Phone input


    public static function getText(self $value): string
    {
        return match ($value) {
            self::INPUT => 'Text',
            self::SELECT => 'Select',
            self::RADIO => 'Radio',
            self::TEXTAREA => 'Textarea',
            self::CHECKBOX => 'Checkbox',
            self::NOTSET => 'Not Set',
            self::DATE => 'Date', // Added this line for the date input
            self::COUNTRY => 'Country_Select', // Added this line for the country input
            self::COUNTRY_CHECKBOX => 'Country_Checkbox', // Added this line for the country checkbox input
            self::EMAIL => 'Email', // Added this line for the country checkbox input
            self::PHONE => 'Phone', // Added this line for the country Phone input
        };
    }
}
