<?php

namespace App\Enums;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum QuestionStatus :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case ACTIVE = 1;
    case INACTIVE = 3;
}
