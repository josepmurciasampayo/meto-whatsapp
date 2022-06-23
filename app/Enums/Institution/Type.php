<?php

namespace App\Enums\Institution;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Type: int
{
    use InvokableCases, Options, Values, Names, Strings;

    case UNIVERSITY = 1;
    case VOCATIONAL = 2;
    case SCHOLARSHIP = 3;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::UNIVERSITY => "University or college",
            self::VOCATIONAL => "Vocational program",
            self::SCHOLARSHIP => "Scholarship or access program",
        };
    }

}
