<?php

namespace App\Enums\Student;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum TagsStudent :int
{

    use InvokableCases, Options, Values, Names, Strings;

    case CITIZENSHIPS = 1;
    case COUNTRYBIRTH = 2;
    case COUNTRYFAMILY = 3;
    case COUNTRYCURRENT = 4;
    case SOCIAL = 5;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::CITIZENSHIPS => 'Chat Campaign',
            self::COUNTRYBIRTH => 'Country of Birth',
            self::COUNTRYFAMILY => 'Country with Family',
            self::COUNTRYCURRENT => 'Country of Residence',
            self::SOCIAL => 'Social Network',
        };
    }
}
