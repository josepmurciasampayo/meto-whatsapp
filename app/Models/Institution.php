<?php

namespace App\Models;

use App\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\In;

class Institution extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'address_1',
        'address_2',
        'city',
        'state',
        'postal_code',
        'country',
        'url',
        'google_id',
        'efc'
    ];

    public static function getByUserID(int $user_id): Institution
    {
        $join = Helpers::dbQueryArray('select institution_id from meto_user_institutions where user_id = ' . $user_id);
        return Institution::find($join->institution_id);
    }
}
