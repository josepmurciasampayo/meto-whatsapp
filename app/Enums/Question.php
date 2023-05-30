<?php

namespace App\Enums;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Question: int
{
    use InvokableCases, Options, Values, Names, Strings;

    case CURRICULUM = 318;

}
