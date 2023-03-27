<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionScreen extends Model
{
    public static function get(int $id) :array
    {
        $toReturn = array();
        $screens = QuestionScreen::where('question_id', $id)->get();
        foreach ($screens as $screen) {
            $toReturn[$screen->curriculum]['screen'] = $screen->screen;
            $toReturn[$screen->curriculum]['order'] = $screen->order;
            $toReturn[$screen->curriculum]['branch'] = $screen->branch;
        }

        return $toReturn;
    }
}
