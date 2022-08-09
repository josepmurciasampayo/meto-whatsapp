<?php

namespace App\Models\Chat;

use App\Enums\Chat\Campaign;
use App\Helpers;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text',
        'campaign',
        'capture_filter',
        'capture_display',
        'answer_table',
        'answer_field',
    ];

    public static function getIDfromCampaign(Campaign $campaign) :?int
    {
        $toReturn = Helpers::dbQueryArray('
            select
            id
            from meto_messages
            where campaign = ' . $campaign() . ';
        ');
        if (is_null($toReturn)) {
            return null;
        }
        return $toReturn[0]['id'];
    }

    public static function collapseResponses($string) :string
    {
        switch ($string) {
            case 'Ye':
            case 'Yes':
                return 'Y';
            case 'No':
                return 'N';
            default:
                return $string;
        }
    }
}
