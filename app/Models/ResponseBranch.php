<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResponseBranch extends Model
{
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function response(): BelongsTo
    {
        return $this->belongsTo(Response::class);
    }

    public function curriculum(): BelongsTo
    {
        return $this->belongsTo(Curriculum::class);
    }

    public static function get($id) :array
    {
        $toReturn = array();
        $responses = ResponseBranch::where('question_id', $id)->get();
        foreach ($responses as $response) {
            $toReturn[$response->response_id][$response->curriculum_id] = $response->to_screen;
        }
        return $toReturn;
    }
}
