<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mail;
use App\Mail\ContactMail;

class ContactForm extends Model
{
    public $fillable = ['user_id', 'name', 'email', 'phone', 'message'];

}
