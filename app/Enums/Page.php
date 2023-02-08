<?php

namespace App\Enums;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Page :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case GETSTARTED = 1;
    case PROFILE = 3;
    case DEMO = 4;
    case HIGHSCHOOL = 5;
    case ACADEMIC = 6;
    case FINANCIAL = 7;
    case EXTRA = 8;
    case UNIPLAN = 9;
    case TESTING = 10;
    case GENERAL = 11;
    case HOME = 12;
    case INTRO = 13;
}
