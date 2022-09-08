<?php

namespace App\Console\Commands;

use App\Enums\Student\Gender;
use App\Enums\User\Role;
use App\Enums\User\Status;
use App\Helpers;
use App\Models\Student;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class importFromGoogle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:importFromGoogle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Connect to Google MySQL and import all relevant data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $query = '
            select * from students_table;
        ';
        $students = DB::connection('google')->select($query);
        foreach ($students as $student) {
            self::importStudent($student);
        }
        return 0;
    }

    private function importStudent(\stdClass $student) {
        /**
        timestamp,
        country_of_birth,
        city_of_birth,
        refugee_status,
        citizenships,
        family_in,
        email_address_2,
        email_owner,
        phone_number,
        phone_owner,
        id_number,
        passport_exp,
        highest_edu_parents,
        social_media_platform,
        social_media_id,
        disability_status,
        submission_device,
        actively_seeking_current_app_cycle,
        curriculum
        **/

        $user = User::where('email', trim($student->email_address_1));
        if (!is_null($user)) {
            return;
        }

        $user = new User();
        $user->first = trim($student->first_name);
        $user->last = trim($student->last_name);
        $user->email = trim($student->email_address_1);
        $user->role = Role::STUDENT();
        $user->status = Status::ACTIVE();
        $user->save();

        $stu = new Student();
        $stu->user_id = $user->id;
        $stu->dob = $student->dob;
        $stu->gender = match (strtolower($student->gender)) {
            'male' =>  Gender::MALE(),
            'female' => Gender::FEMALE(),
            default => Gender::OTHER()
        };
    }
}
