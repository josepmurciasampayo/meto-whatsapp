<?php

namespace Database\Seeders;

use App\Enums\Chat\Campaign;
use Illuminate\Support\Facades\DB;
use App\Enums\User\{Role, Status, Consent, Verified};
use App\Models\Chat\MessageState;
use App\Models\StudentUniversity;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class ChatTestSeeder extends Seeder
{
   public function run()
   {

       $this->createUsers();
       $this->createStudentsAndMatches();
       $this->queueMessages();

       // Have to remove phone numbers from admin users so the chatbot doesn't get caught
       User::find(1)->phone_combined = '';
       User::find(2)->phone_combined = '';
       User::find(3)->phone_combined = '';
   }

   public function createUsers()
    {
        $studentRole = Role::STUDENT();
        $activeStatus = Status::ACTIVE();

        /*
         * Greg Student
         */
        User::create([
            'first' => "Greg",
            'last' => "Student",
            'phone_country' => 1,
            'phone_area' => 571,
            'phone_local' => 2143085,
            'phone_combined' => 15712143085,
            'password' => bcrypt('password'),
            'email' => "gmgarrison+student@gmail.com",
            'role' => $studentRole,
            'status' => $activeStatus,
            //'phone_verified' => Verified::VERIFIED,
            //'whatsapp_consent' => Consent::CONSENT,
        ]);

        /*
         * Ryan Student
         */
        User::create([
            'first' => "Ryan",
            'last' => "Student",
            'phone_country' => 1,
            'phone_area' => 303,
            'phone_local' => 6016774,
            'phone_combined' => 13036016774,
            'password' => bcrypt('password'),
            'email' => "gmgarrison+ryan@gmail.com",
            'role' => Role::STUDENT(),
            'status' => Status::ACTIVE(),
        ]);

        /*
          * Abraham
          */
        User::create([
            'first' => "Abraham",
            'last' => "Student",
            'phone_country' => 231,
            'phone_area' => 886,
            'phone_local' => 416380,
            'phone_combined' =>  231886416380,
            'password' => bcrypt('password'),
            'email' => "gmgarrison+abe@gmail.com",
            'role' => 2,
            'status' => 1,
        ]);

        DB::update('update meto_users set role = ' . $studentRole . ' where role = 0');
        DB::update('update meto_users set status = ' . $activeStatus . ' where status = 0');
    }

   public function createStudentsAndMatches() :void
    {
        $greg_id = DB::select('select id from meto_users where first = "Greg" and last = "Student"')[0]->id;
        $abraham_id = DB::select('select id from meto_users where first = "Abraham" and last = "Student"')[0]->id;
        $ryan_id = DB::select('select id from meto_users where first = "Ryan" and last = "Student"')[0]->id;

        $greg = new Student();
        $greg->user_id = $greg_id;
        $greg->save();

        $abraham = new Student();
        $abraham->user_id = $abraham_id;
        $abraham->save();

        $ryan = new Student();
        $ryan->user_id = $ryan_id;
        $ryan->save();

        $this->createMatches($greg->id, $abraham->id, $ryan->id);
    }

   public function createMatches(int $greg_id, int $abraham_id, int $ryan_id) :void
   {
       /*
        * Greg - BU, Carleton, Hope, Trinity
        */
       $match = new StudentUniversity([
           'student_id' => $greg_id,
           'institution_id' => 2,
           'status' => \App\Enums\General\MatchStudentInstitution::DENIED()
       ]);
       $match->save();

       $match = new StudentUniversity([
           'student_id' => $greg_id,
           'institution_id' => 4,
           'status' => \App\Enums\General\MatchStudentInstitution::ACCEPTED()
       ]);
       $match->save();

       $match = new StudentUniversity([
           'student_id' => $greg_id,
           'institution_id' => 8,
           'status' => \App\Enums\General\MatchStudentInstitution::APPLIED()
       ]);
       $match->save();

       $match = new StudentUniversity([
           'student_id' => $greg_id,
           'institution_id' => 21,
       ]);
       $match->save();


       /*
        * Ryan - Ithaca, Pomona, Union, Worcester, York
        */
       $match = new StudentUniversity([
           'student_id' => $ryan_id,
           'institution_id' => 10,
           'status' => \App\Enums\General\MatchStudentInstitution::DENIED()
       ]);
       $match->save();

       $match = new StudentUniversity([
           'student_id' => $ryan_id,
           'institution_id' => 24,
       ]);
       $match->save();

       $match = new StudentUniversity([
           'student_id' => $ryan_id,
           'institution_id' => 29,
       ]);
       $match->save();

       $match = new StudentUniversity([
           'student_id' => $ryan_id,
           'institution_id' => 31,
       ]);
       $match->save();

       $match = new StudentUniversity([
           'student_id' => $ryan_id,
           'institution_id' => 33,

       ]);
       $match->save();

       /*
        * Abraham - BU, Ithaca, Skidmore, Union, York
        */
       $match = new StudentUniversity([
           'student_id' => $abraham_id,
           'institution_id' => 2,
       ]);
       $match->save();

       $match = new StudentUniversity([
           'student_id' => $abraham_id,
           'institution_id' => 10,
       ]);
       $match->save();

       $match = new StudentUniversity([
           'student_id' => $abraham_id,
           'institution_id' => 12,
       ]);
       $match->save();

       $match = new StudentUniversity([
           'student_id' => $abraham_id,
           'institution_id' => 29,
           'status' => \App\Enums\General\MatchStudentInstitution::ENROLLED
       ]);
       $match->save();

       $match = new StudentUniversity([
           'student_id' => $abraham_id,
           'institution_id' => 33,
           'status' => \App\Enums\General\MatchStudentInstitution::ACCEPTED
       ]);
       $match->save();
   }

    public function queueMessages()
    {
        // Greg
        $user = User::where('email', 'gmgarrison+student@gmail.com')->first();
        MessageState::queueCampaign($user->id, Campaign::ENDOFCYCLE);

        // Abraham
        $user = User::where('email', 'gmgarrison+abe@gmail.com')->first();
        MessageState::queueCampaign($user->id, Campaign::ENDOFCYCLE);

        // Ryan
        $user = User::where('email', 'gmgarrison+ryan@gmail.com')->first();
        MessageState::queueCampaign($user->id, Campaign::ENDOFCYCLE);
    }
}
