<?php

namespace App\Enums\Institution;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum TagsInstitution :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case LOWINCOME = 1;
    case FULLRIDE = 2;
    case MERIT5K = 3;
    case MERIT10K = 4;
    case MERIT15K = 5;
    case MERIT20K = 6;
    case MERIT25K = 7;
    case MERIT30K = 8;
    case MERIT35K = 9;
    case MERITMAX = 10;
    case EFC5K = 11;
    case EFC10K = 12;
    case EFC15K = 13;
    case EFC20K = 14;
    case EFC25K = 15;
    case EFC30K = 16;
    case EFC35K = 17;
    case EFCMAX = 18;
    case REFUGEE = 19;
    case MINSELECT = 20;
    case SELECT = 21;
    case HIGHSELECT = 22;
    case PRIVACYP1 = 23;
    case PRIVACYP2TA = 24;
    case PRIVACYP2TB = 25;
    case PRIVACYP2TC = 26;
    case PRIVACYP2TD = 27;
    case PRIVACYP2TE = 28;

}
