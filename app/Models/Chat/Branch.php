<?php

namespace App\Models\Chat;

use App\Enums\Chat\Campaign;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Branch extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from_message_id',
        'response',
        'to_message_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function getCampaign() :Campaign
    {
        return Campaign::getCampaignFromID($this->from_message_id);
    }

    public static function getBranchByMessageAndResponse(int $message_id, string $body) :?Branch
    {
        $query = "
            select id from meto_branches where from_message_id = " . $message_id . " and response = '" . $body ."';
        ";
        $result = DB::select($query);
        if (count($result) == 0) {
            return null;
        }
        return Branch::find($result[0]->id);
    }
}
