<?php

namespace Database\Seeders;

use App\Models\HighSchool;
use App\Models\Joins\UserHighSchool;
use App\Enums\User\{Role, Status, Consent, Verified};
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Create counselor users
         */
        $user = User::create([
            'first' => "Greg",
            'last' => "Counselor",
            'phone_raw' => "571-214-3085",
            'phone_country' => 1,
            'phone_area' => 571,
            'phone_local' => 2143085,
            'phone_combined' => '', //15712143085,
            'password' => bcrypt('password'),
            'email' => "gmgarrison+counselor@gmail.com",
            'role' => Role::COUNSELOR(),
            'status' => Status::ACTIVE()
        ]);

        UserHighSchool::joinUserHighSchool($user->id, 15, \App\Enums\HighSchool\Role::ADMIN);

        $user = User::create([
            'first' => "Abraham",
            'last' => "Counselor",
            'phone_raw' => "571-214-3085",
            'phone_country' => 1,
            'phone_area' => 571,
            'phone_local' => 2143085,
            'phone_combined' => '', //15712143085,
            'password' => bcrypt('password'),
            'email' => "gmgarrison+abraham@gmail.com",
            'role' => Role::COUNSELOR(),
            'status' => Status::ACTIVE()
        ]);

        UserHighSchool::joinUserHighSchool($user->id, 15, \App\Enums\HighSchool\Role::COUNSELOR);

        /*
         * Create institution users
         */
        User::create([
            'first' => "Ryan",
            'last' => "Institution",
            'phone_country' => 1,
            'phone_area' => 303,
            'phone_local' => 6016774,
            'phone_combined' => 13036016774,
            'password' => bcrypt('password'),
            'email' => "gmgarrison+institution@gmail.com",
            'role' => Role::INSTITUTION(),
            'status' => Status::ACTIVE()
        ]);
    }
}
