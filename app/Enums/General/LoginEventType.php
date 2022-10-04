<?php

namespace App\Enums\General;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum LoginEventType :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case LOGIN = 1;
    case LOGOUT = 2;
    case FAILEDAUTH = 3;
    case RESETPW = 4;
    case RESETPWREQUEST = 5;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::LOGIN => 'Normal',
            self::LOGOUT => 'Logout',
            self::FAILEDAUTH => 'Failed Login',
            self::RESETPW => 'Reset Password',
            self::RESETPWREQUEST => 'Request Password Reset',
        };
    }
}
