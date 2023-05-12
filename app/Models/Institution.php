<?php

namespace App\Models;

use App\Helpers;
use Illuminate\Database\Eloquent\Model;

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
}
