<?php

namespace App\Models;

use App\Enums\User\Role;
use App\Helpers;
use App\Traits\TableName;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, TableName;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first',
        'middle',
        'last',
        'email',
        'password',
        'phone_raw',
        'phone_country',
        'phone_area',
        'phone_local',
        'phone_combined',
        'phone_verified',
        'whatsapp_consent',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'role',
        'status',
        'email_status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function findFromPhone(string $phone) : ?User
    {
        $phone = preg_replace('~\D~', '', $phone);
        $result = Helpers::dbQueryArray('
            select
            id
            from meto_users
            where phone_combined = ' . $phone . ' and role in (' . implode(",", [Role::STUDENT(), Role::INSTITUTION()]) . ');
        ');
        if (is_null($result)) {
            return null;
        }
        $user_id = $result[0]['id'];
        return User::find($user_id);
    }

    public function isAdmin() :bool
    {
        return ($this->role == Role::ADMIN());
    }

    public function isStudent() :bool
    {
        return ($this->role == Role::STUDENT());
    }

    public function isCounselor() :bool
    {
        return ($this->role == Role::COUNSELOR());
    }

    public function isInstitution() :bool
    {
        return ($this->role == Role::INSTITUTION());
    }
}
