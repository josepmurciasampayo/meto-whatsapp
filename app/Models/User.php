<?php

namespace App\Models;

use App\Enums\User\Role;
use App\Helpers;
use App\Traits\TableName;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first',
        'middle',
        'last',
        'title',
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
        'google_id',
    ];

    public static function getByPhone(string $phone) :?User
    {
        $phone = preg_replace('~\D~', '', $phone);
        $result = Helpers::dbQueryArray('
            select
            id
            from meto_users
            where phone_combined = ' . $phone . ' and role in (' . implode(",", [Role::STUDENT(), Role::INSTITUTION()]) . ');
        ');
        if (count($result) == 0) {
            return null;
        }
        $user_id = $result[0]['id'];
        return User::find($user_id);
    }

    public static function getByEmail(string $email) :?User
    {
        return User::where('email', $email)->first();
    }

    public function isAdmin() :bool
    {
        return ($this->role == Role::ADMIN());
    }

    public function isStudent() :bool
    {
        return ($this->role == Role::STUDENT() || $this->role == Role::ADMIN());
    }

    public function isCounselor() :bool
    {
        return ($this->role == Role::COUNSELOR() || $this->role == Role::ADMIN());
    }

    public function isSchoolAdmin() :bool
    {
        $hsRole = DB::select('select role from meto_user_high_schools where user_id = ' . $this->id)[0]->role;
        return ($hsRole == \App\Enums\HighSchool\Role::ADMIN() || $this->role == Role::ADMIN);
    }

    public function isInstitution() :bool
    {
        return ($this->role == Role::INSTITUTION() || $this->role == Role::ADMIN());
    }

    public static function deleteByRole(Role $role) :void
    {
        User::where('role', $role())->delete();
    }

    public function terms() :bool
    {
        return $this->isAdmin() || $this->terms;
    }
}
