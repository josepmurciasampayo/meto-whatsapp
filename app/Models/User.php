<?php

namespace App\Models;

use App\Actions\MetoWelcomeNotification;
use App\Enums\General\YesNo;
use App\Enums\HighSchool\Type;
use App\Enums\Student\Curriculum;
use App\Enums\User\Role;
use App\Enums\HighSchool\Role as HSRole;
use App\Helpers;
use App\Models\Chat\MessageState;
use App\Models\Joins\UserHighSchool;
use App\Models\Joins\UserInstitution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, \Spatie\WelcomeNotification\ReceivesWelcomeNotification;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
        'status',
        'email_status',
    ];

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

    public function userForms(): HasMany
    {
        return $this->hasMany(UserForm::class);
    }

    public function highSchool()
    {
        return $this->hasOneThrough(
            HighSchool::class,
            UserHighSchool::class,
            'user_id',
            'id',
            'id',
            'highschool_id'
        );
    }

    public function highSchools()
    {
        return $this->hasManyThrough(
            HighSchool::class,
            UserHighSchool::class,
            'user_id',
            'id',
            'id',
            'highschool_id'
        );
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

    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
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
        return $this->isAdmin() || $this->terms == YesNo::YES();
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
        $this->notify(new MetoWelcomeNotification($validUntil, $uni));
    }

    public function getUni(): Institution
    {
        return UserInstitution::where('user_id', $this->id)->first()->institution;
    }

    public function getCurriculum(): ?Curriculum
    {
        $answer = Answer::where('question_id', 318)->where('student_id', $this->student_id())->first();
        if ($answer) {
            // response IDs are coded, Curriculum IDs aren't used but should be?
            return match($answer->response_id) {
                46 => Curriculum::CAMBRIDGE,
                47 => Curriculum::AMERICAN,
                48 => Curriculum::IB,
                49 => Curriculum::UGANDAN,
                50 => Curriculum::KENYAN,
                51 => Curriculum::RWANDAN,
                52 => Curriculum::OTHER,

                111049 => Curriculum::BANGLADESH,
                111048 => Curriculum::BRAZIL,
                111047 => Curriculum::EGYPT,
                111046 => Curriculum::ETHIOPIA,
                111045 => Curriculum::GHANA,
                111044 => Curriculum::INDIA,
                111043 => Curriculum::INDONESIA,
                111042 => Curriculum::IRAN,
                111041 => Curriculum::KUWAIT,
                111040 => Curriculum::MEXICO,
                111039 => Curriculum::MOROCCO,
                111038 => Curriculum::NEPAL,
                111037 => Curriculum::NIGERIA,
                111036 => Curriculum::SAUDIARABIA,
                111035 => Curriculum::SOUTHAFRICA,
                111034 => Curriculum::TURKIYE,
                111033 => Curriculum::VIETNAM,
            };
        } else {
            return null;
        }
    }
}
