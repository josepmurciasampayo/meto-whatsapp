<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class QuestionCurriculum extends Model
{
    public function question(): HasOne
    {
        return $this->hasOne(Question::class);
    }

    public function curriculum(): HasOne
    {
        return $this->hasOne(Curriculum::class, 'id', 'curriculum_id');
    }

}
