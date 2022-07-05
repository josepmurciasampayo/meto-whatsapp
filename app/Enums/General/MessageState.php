<?php

namespace App\Enums\General;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum MessageState :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case QUEUED = 1;
    case SENT = 3;
    case REPLIED = 5;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::QUEUED => 'Queued',
            self::SENT => 'Sent',
            self::REPLIED => 'REPLIED',
        };
    }
}
