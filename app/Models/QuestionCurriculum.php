<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class QuestionCurriculum extends Model
{
    public function question(): BelongsTo
    {
        return $this->BelongsTo(Question::class);
    }

    public function curriculum(): BelongsTo
    {
        return $this->BelongsTo(Curriculum::class);
    }

}
