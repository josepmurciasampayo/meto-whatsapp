<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'form_id',
        'url',
        'status',
    ];

    public static function makeURL() :string
    {
        return str_random(8);
    }

}
