<?php

namespace Database\Seeders;

use App\Enums\Student\Consent;
use App\Enums\Student\Verified;
use App\Enums\User\Role;
use App\Enums\User\Status;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userID = 1;
        /*
         * Create admin users
         */
        User::create([
            'id' => $userID++,
            'first' => "Greg",
            'last' => "Garrison",
            'phone_raw' => "571-214-3085",
            'phone_country' => 1,
            'phone_area' => 571,
            'phone_local' => 2143085,
            'password' => bcrypt('password'),
            'email' => "gmgarrison+meto@gmail.com",
            'role' => Role::ADMIN,
            'status' => Status::ACTIVE
        ]);

        User::create([
            'id' => $userID++,
            'first' => "Ryan",
            'last' => "Benitez",
            'phone_country' => 1,
            'phone_area' => 571,
            'phone_local' => 2143085,
            'password' => bcrypt('password'),
            'email' => "ryan@meto-intl.org",
            'role' => Role::ADMIN,
            'status' => Status::ACTIVE
        ]);

        User::create([
            'id' => $userID++,
            'first' => "Abraham",
            'last' => "Barry",
            'phone_country' => 1,
            'phone_area' => 571,
            'phone_local' => 2143085,
            'password' => bcrypt('password'),
            'email' => "abraham@meto-intl.org",
            'role' => Role::ADMIN,
            'status' => Status::ACTIVE
        ]);

        User::create([
            'id' => $userID++,
            'first' => "Nic",
            'last' => "Nesbitt",
            'phone_country' => 1,
            'phone_area' => 571,
            'phone_local' => 2143085,
            'password' => bcrypt('password'),
            'email' => "nic@meto-intl.org",
            'role' => Role::ADMIN,
            'status' => Status::ACTIVE
        ]);


    }
}
