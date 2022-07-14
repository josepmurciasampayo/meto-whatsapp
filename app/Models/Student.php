<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'gender',
        'dob',
        'birth_country',
        'birth_city',
        'refugee_status',
        'email_2',
        'email_owner',
        'phone_owner',
        'government_id',
        'passport_expiry',
        'parent_education',
        'disability',
        'submission_device',
        'current_cycle',
        'curriculum',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_id',
        'trigger_endAppCycle',
    ];
}
