<?php

namespace App\Enums;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum QuestionFormat :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case INPUT = 1;
    case SELECT = 3;
    case RADIO = 4;
    case TEXTAREA = 5;
    case CHECKBOX = 6;
}
