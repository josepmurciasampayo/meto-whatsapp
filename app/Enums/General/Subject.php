<?php

namespace App\Enums\General;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Subject :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case NORMAL = 1;
    // select distinct response from answers_table where question_id = 9;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::NORMAL => 'Normal',
        };
    }
}
