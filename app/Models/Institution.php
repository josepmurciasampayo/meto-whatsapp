<?php

namespace App\Models;

use App\Helpers;
use App\Models\Joins\UserInstitution;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\In;

class Institution extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'address_1',
        'address_2',
        'city',
        'state',
        'postal_code',
        'country',
        'url',
        'google_id',
        'efc',
        'min_grade',
        'min_grade_curriculum',
        'min_grade_equivalency'
    ];

    public static function getByUserID(int $user_id): Institution
    {
        $institution = Institution::where('user_id', $user_id)->first();

        return Institution::find($institution->institution_id);
    }

    public function users()
    {
        return $this->hasMany(UserInstitution::class);
    }

    public function admins()
    {
        return $this->hasManyThrough(
            User::class,
            UserInstitution::class,
            'institution_id',
            'id'
        );
    }
}
