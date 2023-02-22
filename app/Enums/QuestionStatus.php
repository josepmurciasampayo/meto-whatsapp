<?php

namespace App\Enums;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum QuestionStatus :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case ACTIVE = 1;
    case INACTIVE = 3;

    public static function getText(self $value) :string
    {
        return match ($value) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
            '' => 'Not set',
        };
    }
}
