<?php

namespace App\Enums\Chat;

use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Campaign :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case NOBRANCH = 0;
    case CONFIRMIDENTITY = 1;
    case CONFIRMPERMISSION = 5;
    case UNKNOWNMESSAGE = 4;
    case ENDOFCYCLE = 3;
    case GOODBYE = 2;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::NOBRANCH => 'No Connected Branches',
            self::CONFIRMIDENTITY => 'Confirm Identity',
            self::CONFIRMPERMISSION => 'Confirm Permission to Collect Info',
            self::ENDOFCYCLE => 'End of Application Cycle Survey',
            self::UNKNOWNMESSAGE => 'Unknown Message Response',
            self::GOODBYE => 'No problem. We won\'t message you anymore.',
        };
    }

    public static function getCampaignFromMessage(int $message_id) :Campaign
    {
        return Campaign::from($message_id);
    }
}
