<?php

namespace App\Models;

use App\Actions\MetoWelcomeNotification;
use App\Enums\General\YesNo;
use App\Enums\HighSchool\Type;
use App\Enums\User\Role;
use App\Enums\HighSchool\Role as HSRole;
use App\Helpers;
use App\Models\Chat\MessageState;
use App\Models\Joins\UserHighSchool;
use App\Models\Joins\UserInstitution;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, \Spatie\WelcomeNotification\ReceivesWelcomeNotification;

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
        'role',
        'status',
        'password',
        'phone_raw',
        'phone_country',
        'phone_area',
        'phone_local',
        'phone_combined',
        'phone_verified',
        'whatsapp_used',
        'whatsapp_consent',
        'interest',
        'phone_array',
        'phone_owner'
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

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'phone_array' => 'array'
    ];

    public function contactForms()
    {
        return $this->hasMany(ContactForm::class, 'user_id');
    }

    public function metoFiles()
    {
        return $this->hasMany(File::class, 'owner_id');
    }

    public function loginEvents()
    {
        return $this->hasMany(LoginEvents::class);
    }

    public function messageStates()
    {
        return $this->hasMany(MessageState::class);
    }

    public function userForms()
    {
        return $this->hasMany(UserForm::class);
    }

    public function highSchools()
    {
        return $this->hasMany(UserHighSchool::class);
    }

    public static function getByPhone(string $phone): ?User
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

    public static function getByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function isAdmin(): bool
    {
        return ($this->role == Role::ADMIN());
    }

    public function isStudent(): bool
    {
        return ($this->role == Role::STUDENT());
    }

    public function student(): ?Student
    {
        return Student::where('user_id', $this->id)->first();
    }

    public function student_id(): ?int
    {
        $student = Student::where('user_id', $this->id)->first();
        if ($student) {
            return $student->id;
        }
        return null;
    }

    public function isCounselor(): bool
    {
        return ($this->role == Role::COUNSELOR());
    }

    public function isSchoolAdmin(): bool
    {
        $hsRole = DB::select('select role from meto_user_high_schools where user_id = ' . $this->id)[0]->role;
        return ($hsRole == \App\Enums\HighSchool\Role::ADMIN() || $this->role == Role::ADMIN);
    }

    public function isInstitution(): bool
    {
        return ($this->role == Role::INSTITUTION() || $this->role == Role::ADMIN());
    }

    public static function deleteByRole(Role $role): void
    {
        User::where('role', $role())->delete();
    }

    public function terms(): bool
    {
        return $this->isAdmin() || $this->terms;
    }

    public function consent(): bool
    {
        return $this->isAdmin() || $this->consent == YesNo::YES();
    }

    public static function getCounselorsAtHS(int $highschool_id): array
    {
        return Helpers::dbQueryArray('
            select u.id as user_id, h.highschool_id, h.role, concat(u.first, " ", u.last) as name, u.email
            from meto_users as u
            join meto_user_high_schools as h on h.user_id = u.id and h.role in (' . HSRole::ADMIN() . ', ' . HSRole::COUNSELOR() . ')
            where h.highschool_id = ' . $highschool_id . ' ;
        ');
    }

    public function isCounselorAtAP(): bool
    {
        $row = Helpers::dbQueryArray('
        select h.type
        from meto_user_high_schools as uh
        join meto_high_schools as h on uh.highschool_id = h.id
        where user_id= ' . $this->id . ';
        ');

        return $row[0]['type'] == Type::ACCESS();
    }

    public static function getIDbyStudentID(int $student_id): int
    {
        $row = Helpers::dbQueryArray('
            select u.id
            from meto_users as u
            join meto_students as s on s.user_id = u.id
            where s.id = ' . $student_id . ';
        ');

        return $row[0]['id'];
    }

    public function getFullName()
    {
        return $this->first . ' ' . $this->last;
    }

    public function sendWelcomeNotification(\Carbon\Carbon $validUntil, Institution $uni)
    {
        $this->notify(new MetoWelcomeNotification($validUntil, $uni, $this));
    }

    public function getUni(): Institution
    {
        return UserInstitution::where('user_id', $this->id)->first()->institution;
    }
}
