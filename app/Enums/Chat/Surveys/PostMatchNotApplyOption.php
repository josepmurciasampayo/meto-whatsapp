<?php

namespace App\Enums\Chat\Surveys;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum PostMatchNotApplyOption :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case STANDARDS = 1;
    case COUNTRY = 2;
    case PASTDENIAL = 3;
    case NOMORE = 4;
    case NOTIME = 5;
    case NOTSUREHOWTOAPPLY = 6;
    case DATABUNDLES = 7;
    case OTHER = 8;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::STANDARDS => "This institution is not up to my academic standards",
            self::COUNTRY => "I do not want to study in this country",
            self::PASTDENIAL => "I applied in the past and was not admitted",
            self::NOMORE => "I am not looking for more universities at this time",
            self::NOTIME => "The deadline is too soon —  I do not have time to complete an application",
            self::NOTSUREHOWTOAPPLY => "I do not know how to apply",
            self::DATABUNDLES => "I do not have enough money to buy the data bundles I need to complete an application",
            self::OTHER => "Other",

        };
    }
}
