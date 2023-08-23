<?php

namespace App\Console\Commands;

use App\Models\HighSchool;
use App\Models\Institution;
use Faker\Factory;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AnonymizeApp extends Command
{
        private $nullable = [
            'middle',
            'phone_raw',
            'phone_local',
            'phone_combined',
            'linkedin_url',
            'phone_array',
            'known_for',
            'academic_reputation',
            'majors_url',
            'extracurriculars',
            'international',
            'application_timing',
            'application_process',
            'testing_policy',
            'student_life_url',
            'tour_url',
            'general_email',
        ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:anonymize-app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::raw('SET FOREIGN_KEY_CHECKS = 0;');
        DB::raw('drop table if exists meto_telescope_entries');
        DB::raw('drop table if exists meto_telescope_entries_tags');
        DB::raw('drop table if exists meto_telescope_entries_monitoring');
        DB::raw('drop table if exists meto_log_comms');
        DB::raw('SET FOREIGN_KEY_CHECKS = 1;');

        $faker = Factory::create();

        $users = User::all();
        foreach ($users as $user) {
            $user->first = $faker->firstName();
            $user->last = $faker->lastName();
            $user->email = Str::random(10) . "@email.com";
            $user->password = '$2y$10$nLPI94.NnBeFSzLbaLJ75eNNWrg.aCuVLa0ONfuJk2i8HVW/0n79u';

            $this->nullFields($user);


            $user->save();
        }

        $institutions = Institution::all();
        foreach ($institutions as $institution) {
            $institution->name = $faker->company();
            $institution->nickname = $faker->company();
            $institution->apply_url = $faker->url();
            $institution->save();
        }

        $highschools = HighSchool::all();
        foreach ($highschools as $hs) {
            $hs->name = $faker->company();
            $hs->url = $faker->url();
            $hs->save();
        }

    }

    public function nullFields(Model $model) {
        foreach ($this->nullable as $field) {
            if (isset($model->$field)) {
                $model->$field = null;
            }
        }
        $model->save();
    }
}
