<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Curriculum extends Model
{
    use HasFactory;

    public $table = 'curricula';

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class)
            ->withPivot([
                'screen',
                'order',
            ]);
    }
}
