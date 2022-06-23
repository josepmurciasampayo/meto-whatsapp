<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text',
        'capture_filter',
        'capture_display',
        'answer_table',
        'answer_field',
        'branch_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

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
