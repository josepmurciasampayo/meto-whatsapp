<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseBranch extends Model
{
    public static function get($id) :array
    {
        $toReturn = array();
        $responses = ResponseBranch::where('question_id', $id)->get();
        foreach ($responses as $response) {
            $toReturn[$response->response_id][$response->curriculum] = $response->to_screen;
        }
        return $toReturn;
    }
}
