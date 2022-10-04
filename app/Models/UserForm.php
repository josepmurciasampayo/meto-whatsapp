<?php

namespace App\Models;

use App\Enums\General\Form;
use App\Enums\General\FormStatus;
use App\Imports\Students;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserForm extends Model
{
    protected $fillable = [
        'user_id',
        'form_id',
        'url',
        'status',
    ];

    public static function getForm(int $user_id, Form $form) :?UserForm
    {
        /*
        $id = DB::select('
            select id from meto_user_forms where user_id = ' . $user_id . ' and form_id = ' . $form() . ';
        ');
        */
        $existing = UserForm::where(['user_id' => $user_id, 'form_id' => $form()]);
        if ($existing->count() > 0) {
            return $existing->first();
        }

        return self::createForm($user_id, $form);
    }

    public static function createForm(int $user_id, Form $form) :?UserForm
    {
        if (Student::countMatches($user_id) == 0) {
            return null;
        }
        $new = new UserForm([
            'user_id' => $user_id,
            'form_id' => $form(),
            'url' => Str::random(8),
            'status' => FormStatus::CREATED,
        ]);
        $new->save();
        return $new;
    }

}
