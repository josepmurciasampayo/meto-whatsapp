<?php

namespace App\Enums\Student;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Refugee :int
{
    use InvokableCases, Options, Values, Names, Strings;

    public static function getText(self $value) :string
    {

    }

}
