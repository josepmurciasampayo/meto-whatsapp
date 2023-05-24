<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewStudentTableData extends Model
{
    use HasFactory;

    // TODO: Change the SQL view name
    public $table = 'view_questions';
}
