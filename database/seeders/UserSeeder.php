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
        /*
         * Create admin users
         */

        $role = Role::ADMIN();
        $status = Status::ACTIVE();

        User::create([
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


        User::create([
            'first' => "Blake",
            'last' => "Thomsen",
            'phone_country' => 1,
            'phone_area' => 949,
            'phone_local' => 3025745,
            'phone_combined' => 19493025745,
            'password' => '$2y$10$Fb74ZFyoif3UjYiQbI2dyOUm0K5RuNSM5xK1Okk6XkOZojudXsrHq',
            'email' => "bthomsen@meto-intl.org",
            'role' => Role::ADMIN(),
            'status' => Status::ACTIVE()
        ]);

        User::create([
            'first' => "Hayat",
            'last' => "Seid",
            'phone_country' => 251,
            'phone_area' => 987,
            'phone_local' => 314242,
            'phone_combined' => 251987314242,
            'password' => '$2y$10$ruF06R7f9iAWdD5Y7SKwXuvvqQipPBllD4sWqkigzg4rG/ZCJTr9.',
            'email' => "hseid@meto-intl.org",
            'role' => Role::ADMIN(),
            'status' => Status::ACTIVE()
        ]);

        User::create([
            'first' => "Nic",
            'last' => "Nesbitt",
            'phone_country' => 1,
            'phone_area' => 952,
            'phone_local' => 3883878,
            'password' => bcrypt('justmakeitreallyhardtoguess2123451'),
            'email' => "nic@meto-intl.org",
            'role' => Role::ADMIN(),
            'status' => Status::ACTIVE()
        ]);

        /* first four counselor accounts */
        User::create([
            'first' => "Uwingabire",
            'last' => "Jeninah",
            'title' => "Ladies Coordinator",
            'password' => '$2y$10$hfulfVv2POT7QfnI3zy9c.Xy/CVuzoup/TNzW0vtWYzGST6RnsxeO',
            'email' => "jeninah12@gmail.com",
            'role' => Role::COUNSELOR(),
            'status' => Status::ACTIVE()
        ]);

        /*
        User::create([
            'first' => "Luladey",
            'last' => "Teshome",
            'password' => '$2y$10$eqssId9qDJXIZfR3aCUgiOu33gSdtgxxW8QwUgetbYtLacXFUlA5y',
            'title' => "Director of College and Career Counseling",
            'email' => "counselor@maranyundogirlsschool.org",
            'role' => Role::COUNSELOR(),
            'status' => Status::ACTIVE()
        ]);

        User::create([
            'first' => "Lucinda",
            'last' => "Ochieng",
            'password' => '$2y$10$1atdp/n36j1ZBd60rNEjheh0ltEX3VtY.5mSja1MKmUZ29Y6sxgTK',
            'title' => "University Counselor",
            'email' => "lucinda.ochieng@agakhanacademies.org",
            'role' => Role::COUNSELOR(),
            'status' => Status::ACTIVE()
        ]);
        */

        // Counselor school associations is done in the Google Seeder

    }
}
