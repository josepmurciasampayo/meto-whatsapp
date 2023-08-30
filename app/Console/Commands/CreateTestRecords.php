<?php

namespace App\Console\Commands;

use App\Enums\General\YesNo;
use App\Enums\HighSchool\Type;
use App\Enums\Student\Curriculum;
use App\Enums\User\Consent;
use App\Enums\User\Role;
use App\Enums\User\Status;
use App\Mail\Console\ReportTestRecords;
use App\Models\HighSchool;
use App\Models\Joins\UserHighSchool;
use App\Models\Student;
use App\Models\User;
use Faker\Factory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CreateTestRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-test-records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates records and relationships between them for testing.';

    /**
     * @var \Faker\Generator
     */
    public $faker;

    public string $password = 'password';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::transaction(function () use (&$highSchool, &$counselors, &$user, &$student) {
            $this->faker = Factory::create();

            // 1 - Create a high school and an admin to attach to it
            $highSchool = $this->createHighSchoolAndAdmin();

            // 2 - Create counselors
            $counselors = $this->createHighSchoolCounselors($highSchool);

            // 3 - Create a user
            $user = $this->createUser('student1@hs.com');

            // 4 - Make the created user a student
            $student = $this->createStudent($user, $highSchool);
        });

        Mail::to('abraham@meto-intl.org')
            ->send(new ReportTestRecords($highSchool, $this->password));
    }

    private function createHighSchoolAndAdmin()
    {
        $this->faker->addProvider(new \Bezhanov\Faker\Provider\Educator($this->faker));

        $highSchool = HighSchool::create([
            'name' => $this->faker->university,
            'curriculum' => Curriculum::IB,
            'type' => Type::PUBLIC,
            'verified' => true
        ]);

        $this->info('High school was created successfully.');

        $admin = $this->createUser('admin@hs.com', Role::COUNSELOR);

        $this->info('Admin was created successfully.');

        // Attach admin to high school
        UserHighSchool::create([
            'user_id' => $admin->id,
            'highschool_id' => $highSchool->id,
            'role' => \App\Enums\HighSchool\Role::ADMIN,
            'status' => true,
            'sub_email' => true
        ]);

        $this->info('Admin was attached to high school successfully.');

        return $highSchool;
    }

    private function createHighSchoolCounselors(HighSchool $highSchool)
    {
        $counselors = [];

        for ($i = 1; $i < 3; $i++) {
            $counselor = User::create([
                'first' => $this->faker->firstName,
                'last' => $this->faker->lastName,
                'email' => "counselor-$i@hs.com",
                'password' => Hash::make($this->password),
                'role' => Role::COUNSELOR,
                'status' => Status::ACTIVE
            ]);

            UserHighSchool::create([
                'user_id' => $counselor->id,
                'highschool_id' => $highSchool->id,
                'role' => \App\Enums\HighSchool\Role::COUNSELOR,
                'status' => true,
                'sub_email' => true
            ]);

            $counselors[] = $counselor;
        }

        $this->info(count($counselors) . ' counselors were created successfully.');

        $this->info('Counselors were attached to high school successfully.');

        return $counselors;
    }

    private function createUser($email, $role = null)
    {
        return User::create([
            'first' => $this->faker->firstName,
            'last' => $this->faker->lastName,
            'email' => $email,
            'phone_country' => 1,
            'phone_local' => 123123123,
            'phone_array' => json_encode([
                'code' => 1,
                'number' => 123123123
            ]),
            'phone_combined' => 1123123123,
            'password' => Hash::make($this->password),
            'reminder' => YesNo::YES, // so popup does not appear on first home page visit
            'role' => $role ?? Role::STUDENT,
            'status' => Status::ACTIVE,
            'consent' => true
        ]);
    }

    private function createStudent(User $user, HighSchool $highSchool)
    {
        $student = Student::create([
            'user_id' => $user->id,
            'curriculum' => Curriculum::getText(Curriculum::VIETNAM) . ' Curriculum',
            'curriculum_id' => Curriculum::VIETNAM
        ]);

        $this->info('Student was created successfully.');

        // Attach the created student to the created high school
        UserHighSchool::create([
            'user_id' => $user->id,
            'highschool_id' => $highSchool->id,
            'role' => \App\Enums\HighSchool\Role::STUDENT,
            'status' => true,
            'sub_email' => true
        ]);

        $this->info('Student was attached to high school successfully.');

        return $student;
    }
}
