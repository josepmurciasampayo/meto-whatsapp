<?php

namespace App\Enums;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum QuestionFormat: int
{
    use InvokableCases, Options, Values, Names, Strings;

    case NOTSET = 0;
    case INPUT = 1; // text
    case SELECT = 3; // ID
    case RADIO = 4; // ID
    case TEXTAREA = 5; // text
    case CHECKBOX = 6; // text
    case DATE = 7; // text
    case COUNTRY = 8; // ID
    case COUNTRY_CHECKBOX = 9; // text
    case EMAIL = 10; // text
    case PHONE = 11; // text
    case NUMBER = 13; // text
    case SELECTWITHOTHER = 15; // MESS
    case LOOKUP = 19; // text
    case LOOKUPORG = 26; // text

    public static function hasResponses() {
        return
            [
                self::CHECKBOX(),
                self::RADIO(),
                self::SELECT(),
                self::SELECTWITHOTHER(),
            ];
    }

    public static function getText(self $value): string
    {
        return match ($value) {
            self::NOTSET => "Not Set",
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
            self::PHONE => 'Phone', // Added this line for the Phone input
            self::NUMBER => 'Number', // Added this line for the Number input
            self::SELECTWITHOTHER => "Select with Other",
            self::LOOKUP => "High School Lookup",
            self::LOOKUPORG => "Organization Lookup",
        };
    }
}
