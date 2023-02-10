<?php

namespace App\Enums\Chat\Surveys;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum PostMatchNotSureOption :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case MOREINFO = 1;
    case PARENTS = 2;
    case ADVISOR = 3;
    case OTHER = 4;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::MOREINFO => "I need more information on the institution",
            self::PARENTS => "I need to discuss this with my parents",
            self::ADVISOR => "I need to discuss this with my university advisor",
            self::OTHER => "Other",
        };
    }
}
