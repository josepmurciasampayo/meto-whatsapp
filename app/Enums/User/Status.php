<?php

namespace App\Enums\User;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Status: int
{
    use InvokableCases, Options, Values, Names, Strings;

    case ACTIVE = 4;
    case INACTIVE = 5;

    public static function getText(self $value) :string
    {
        return match ($value) {
            Status::ACTIVE => "Active",
            Status::INACTIVE => "Inactive",
        };
    }
}
