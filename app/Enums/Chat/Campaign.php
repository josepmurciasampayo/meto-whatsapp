<?php

namespace App\Enums\Chat;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Campaign :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case CONFIRMIDENTITY = 1;
    case CONFIRMPERMISSION = 2;
    case UNKNOWNMESSAGE = 3;
    case ENDOFCYCLE = 4;
    case GOODBYE = 5;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::CONFIRMIDENTITY => 'Confirm Identity',
            self::CONFIRMPERMISSION => 'Confirm Permission to Collect Info',
            self::ENDOFCYCLE => 'End of Application Cycle Survey',
            self::UNKNOWNMESSAGE => 'Unknown Message Response',
            self::GOODBYE => 'No problem. We won\'t message you anymore.',
        };
    }

    public static function getCampaignFromID(int $message_id) :Campaign
    {
        return Campaign::from($message_id);
    }
}
