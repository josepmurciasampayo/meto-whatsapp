<?php

namespace App\Enums\Chat;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum State :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case QUEUED = 1;
    case WAITING = 2;
    case REPLIED = 3;
    case ERROR = 4;
    case COMPLETE = 5;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::QUEUED => 'Queued',
            self::SENT => 'Sent',
            self::REPLIED => 'Replied',
            self::ERROR => 'Error',
            self::COMPLETE => 'Complete',
        };
    }
}
