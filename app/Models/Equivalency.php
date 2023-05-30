<?php

namespace App\Models;

use App\Enums\Student\Curriculum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equivalency extends Model
{
    use HasFactory;

    public $table = "equivalency";
}
