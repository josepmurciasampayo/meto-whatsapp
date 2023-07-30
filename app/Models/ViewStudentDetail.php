<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewStudentDetail extends Model
{
    use HasFactory;

    public $table = 'view_student_zdetail';

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
