<?php

namespace App\Enums;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum QuestionFormat :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case NOTSET = 0;
    case INPUT = 1;
    case SELECT = 3;
    case RADIO = 4;
    case TEXTAREA = 5;
    case CHECKBOX = 6;

    public static function getText(self $value) :string
    {
        return match ($value) {
            self::INPUT => 'Text',
            self::SELECT => 'Select',
            self::RADIO => 'Radio',
            self::TEXTAREA => 'Textarea',
            self::CHECKBOX => 'Checkbox',
            self::NOTSET => 'Not Set',
        };
    }
}
