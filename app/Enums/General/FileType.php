<?php

namespace App\Enums\General;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum FileType :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case PROFILE_PIC = 1;
    case PROFILE_DOC = 2;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::PROFILE_PIC => 'Profile photo',
            self::PROFILE_DOC => 'School profile document',
        };
    }
}
