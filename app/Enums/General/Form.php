<?php

namespace App\Enums\General;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Form :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case ENDOFCYCLE = 1;
    case POSTMATCH = 2;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::ENDOFCYCLE => 'End of Application Cycle Survey',
            self::POSTMATCH => 'Post-Match Intent Survey',
        };
    }
}
