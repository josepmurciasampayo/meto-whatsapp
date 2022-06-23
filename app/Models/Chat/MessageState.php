<?php

namespace App\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageState extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'message_id',
        'state',
        'response',
        'last_changed',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'last_changed' => 'datetime',
    ];

    public static function getMessagesToSend() :array
    {
        $toReturn = DB::select('');
        return $toReturn;
    }

    public static function updateMessageState($user_id, $message_id, $state) :void
    {
        DB::update('
            set
        ');
    }
}
