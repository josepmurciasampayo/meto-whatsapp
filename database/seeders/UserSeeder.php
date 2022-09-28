<?php

namespace Database\Seeders;

use App\Enums\User\{Role, Status};
use App\Models\User;
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

        $role = Role::ADMIN();
        $status = Status::ACTIVE();

        User::create([
            'id' => $userID++,
            'first' => "Greg",
            'last' => "Garrison",
            'phone_raw' => "571-214-3085",
            'phone_country' => 1,
            'phone_area' => 571,
            'phone_local' => 2143085,
            'phone_combined' => '', //15712143085,
            'password' => '$2a$10$fYGTd1B2cXuQ.YohRPcuQexfBoJ/ixYtCt4hgmIOgTuyhnBIxwHni',
            'email' => "gmgarrison@gmail.com",
            'role' => $role,
            'status' => $status,
        ]);

        User::create([
            'id' => $userID++,
            'first' => "Ryan",
            'last' => "Benitez",
            'phone_country' => 1,
            'phone_area' => 303,
            'phone_local' => 6016774,
            'phone_combined' => 13036016774,
            'password' => '$2y$10$UlSwHCse51dlFFb/Xsr3rewNopIivLjAnTdkLh1O01MKvQ2wGxxom',
            'email' => "benitez@meto-intl.org",
            'role' => Role::ADMIN(),
            'status' => Status::ACTIVE()
        ]);

        User::create([
            'id' => $userID++,
            'first' => "Abraham",
            'last' => "Barry",
            'phone_country' => 231,
            'phone_area' => 886,
            'phone_local' => 416380,
            'phone_combined' => 1231886416380,
            'password' => '$2a$10$NteedlJ0/e.f/EYz8ywbN.BApYX.S6jIq9RKo6rI24h9kAhV.RN.6',
            'email' => "abraham@meto-intl.org",
            'role' => Role::ADMIN(),
            'status' => Status::ACTIVE()
        ]);

        /*
        User::create([
            'id' => $userID++,
            'first' => "Nic",
            'last' => "Nesbitt",
            'phone_country' => 1,
            'phone_area' => 952,
            'phone_local' => 3883878,
            'password' => bcrypt('password'),
            'email' => "nic@meto-intl.org",
            'role' => Role::ADMIN(),
            'status' => Status::ACTIVE()
        ]);
*/
    }
}
