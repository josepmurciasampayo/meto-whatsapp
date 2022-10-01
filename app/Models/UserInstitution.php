<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInstitution extends Model
{
    public static function joinUserInstitution(int $user_id, int $institution_id) :UserInstitution
    {
        $new = new UserInstitution();
        $new->user_id = $user_id;
        $new->institution_id = $institution_id;
        $new->save();

        return $new;
    }
}
