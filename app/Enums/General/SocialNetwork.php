<?php

namespace App\Enums\General;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum SocialNetwork :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case FACEBOOK = 10;
    case TWITTER = 11;
    case WHATSAPP = 12;
    case TWITCH = 13;
    case INSTAGRAM = 14;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::FACEBOOK => "Facebook",
            self::TWITTER => "Twitter",
            self::WHATSAPP => "WhatsApp",
            self::TWITCH => "Twitch",
            self::INSTAGRAM => "Instagram",
        };
    }
}
