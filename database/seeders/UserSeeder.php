<?php

namespace Database\Seeders;

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
            'phone' => "571-214-3085",
            'password' => bcrypt('password'),
            'email' => "gmgarrison+meto@gmail.com",
            'role' => Role::ADMIN,
            'status' => Status::ACTIVE
        ]);

        User::create([
            'id' => $userID++,
            'first' => "Ryan",
            'last' => "Benitez",
            'phone' => "571-214-3085",
            'password' => bcrypt('password'),
            'email' => "ryan@meto-intl.org",
            'role' => Role::ADMIN,
            'status' => Status::ACTIVE
        ]);

        User::create([
            'id' => $userID++,
            'first' => "Abraham",
            'last' => "Garrison",
            'phone' => "571-214-3085",
            'password' => bcrypt('password'),
            'email' => "abraham@meto-intl.org",
            'role' => Role::ADMIN,
            'status' => Status::ACTIVE
        ]);

        User::create([
            'id' => $userID++,
            'first' => "Nic",
            'last' => "Garrison",
            'phone' => "571-214-3085",
            'password' => bcrypt('password'),
            'email' => "nic@meto-intl.org",
            'role' => Role::ADMIN,
            'status' => Status::ACTIVE
        ]);

        /*
         * create student test accounts
         */
        User::create([
            'id' => $userID,
            'first' => "Greg",
            'last' => "Student" . $userID,
            'phone' => "571-214-3085",
            'password' => bcrypt('password'),
            'email' => "gmgarrison+student@gmail.com",
            'role' => Role::ADMIN,
            'status' => Status::ACTIVE
        ]);

        $studentID = 1;

        Student::create([
            'id' => $studentID++,
            'user_id' => $userID++,
            'phone_verified' => null,
            'whatsapp_consent' => null,
        ]);

        User::create([
            'id' => $userID,
            'first' => "Ryan",
            'last' => "Student" . $userID,
            'phone' => "571-214-3085",
            'password' => bcrypt('password'),
            'email' => "gmgarrison+ryan@gmail.com",
            'role' => Role::ADMIN,
            'status' => Status::ACTIVE
        ]);

        Student::create([
            'id' => $studentID++,
            'user_id' => $userID++,
            'phone_verified' => null,
            'whatsapp_consent' => null,
        ]);

        User::create([
            'id' => $userID,
            'first' => "Abraham",
            'last' => "Student" . $userID,
            'phone' => "571-214-3085",
            'password' => bcrypt('password'),
            'email' => "gmgarrison+abe@gmail.com",
            'role' => Role::ADMIN,
            'status' => Status::ACTIVE
        ]);

        Student::create([
            'id' => $studentID++,
            'user_id' => $userID++,
            'phone_verified' => null,
            'whatsapp_consent' => null,
        ]);

        User::create([
            'id' => $userID,
            'first' => "Nic",
            'last' => "Student" . $userID,
            'phone' => "571-214-3085",
            'password' => bcrypt('password'),
            'email' => "gmgarrison+nic@gmail.com",
            'role' => Role::ADMIN,
            'status' => Status::ACTIVE
        ]);

        Student::create([
            'id' => $studentID++,
            'user_id' => $userID++,
            'phone_verified' => null,
            'whatsapp_consent' => null,
        ]);
    }
}
