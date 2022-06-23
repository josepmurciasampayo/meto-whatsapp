<?php

namespace App\Enums;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum EnumGroup: int
{
    case GENERAL = 0;
    case USER = 1;
    case STUDENT = 2;
    case INSTITUTION = 3;
    case MATCH = 4;
    case COUNTRY = 5;
    case SUBREGION = 6;
    case REGION = 7;

}
