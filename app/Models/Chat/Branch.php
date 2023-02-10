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
        return Campaign::getCampaignFromMessage($this->from_message_id);
    }

    public static function getBranchByMessageAndResponse(int $message_id, string $body) :?Branch
    {
        $query = "
            select id, response
            from meto_branches
            where from_message_id = " . $message_id . " ;
        ";
        $results = DB::select($query);
        if (count($results) == 0) {
            return null;
        }
        if (count($results) == 1) {
            return Branch::find($results[0]->id);
        }
        foreach ($results as $result) {
            if ($body == $result['response']) {
                return Branch::find($result['id']);
            }
        }
        return null;
    }
}
