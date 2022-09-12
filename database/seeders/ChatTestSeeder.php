<?php

namespace Database\Seeders;

use App\Enums\Chat\Campaign;
use App\Enums\General\Form;
use App\Enums\General\FormStatus;
use App\Models\UserForm;
use App\Enums\User\{Role, Status, Consent, Verified};
use App\Models\Chat\MessageState;
use App\Models\MatchStudentInstitution;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class ChatTestSeeder extends Seeder
{
   public function run(bool $createUsers = true)
   {
       if ($createUsers) {
           $this->createUsers();
       }
       $this->queueMessages();
   }

   public function queueMessages()
   {
       // Greg
       $user = User::where('email', 'gmgarrison+student@gmail.com')->first();
       MessageState::queueCampaign($user->id, Campaign::ENDOFCYCLE);

       // Abraham
       /*
       $user = User::where('email', 'gmgarrison+abe@gmail.com')->first();
       MessageState::queueCampaign($user->id, Campaign::ENDOFCYCLE);
       MessageState::queueCampaign($user->id, Campaign::CONFIRMPERMISSION, 2);
       MessageState::queueCampaign($user->id, Campaign::CONFIRMIDENTITY, 1);
       */

       // Ryan
       /*
       $user = User::where('email', 'gmgarrison+ryan@gmail.com')->first();
       MessageState::queueCampaign($user->id, Campaign::ENDOFCYCLE);
       */
   }

   public function createUsers() {
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
           'role' => Role::STUDENT,
           'status' => Status::ACTIVE,
           //'phone_verified' => Verified::VERIFIED,
           //'whatsapp_consent' => Consent::CONSENT,
       ]);

       $user_id = User::all()->count();

       Student::create([
           'user_id' => $user_id,
       ]);

       /*
        * Greg - BU, Carleton, Hope, Trinity
        */
       $match = new MatchStudentInstitution([
           'student_id' => Student::all()->count(),
           'institution_id' => 2,
           'status' => \App\Enums\General\MatchStudentInstitution::DENIED()
       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => Student::all()->count(),
           'institution_id' => 4,
           'status' => \App\Enums\General\MatchStudentInstitution::ACCEPTED()
       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => Student::all()->count(),
           'institution_id' => 8,
           'status' => \App\Enums\General\MatchStudentInstitution::APPLIED()
       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => Student::all()->count(),
           'institution_id' => 21,
       ]);
       $match->save();

       $form = new UserForm([
           'user_id' => User::all()->count(),
           'form_id' => Form::ENDOFCYCLE,
           'status' => FormStatus::SENT,
           'url' => 'TLW5CBD2',
       ]);
       $form->save();

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
           'phone_verified' => Verified::VERIFIED(),
       ]);

       $user_id = User::all()->count();

       Student::create([
           'user_id' => $user_id,
       ]);

       /*
        * Ryan - Ithaca, Pomona, Union, Worcester, York
        */
       $match = new MatchStudentInstitution([
           'student_id' => Student::all()->count(),
           'institution_id' => 10,
           'status' => \App\Enums\General\MatchStudentInstitution::DENIED()
       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => Student::all()->count(),
           'institution_id' => 24,
       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => Student::all()->count(),
           'institution_id' => 29,
       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => Student::all()->count(),
           'institution_id' => 31,
       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => Student::all()->count(),
           'institution_id' => 33,

       ]);
       $match->save();


       /*
        * Abraham
        */
       User::create([
           'first' => "Abraham",
           'last' => "Student",
           'phone_country' => 231,
           'phone_area' => 886,
           'phone_local' => 416380,
           'phone_combined' => 231886416380,
           'password' => bcrypt('password'),
           'email' => "gmgarrison+abe@gmail.com",
           'role' => Role::STUDENT,
           'status' => Status::ACTIVE,
           'whatsapp_consent' => Consent::CONSENT,
       ]);

       Student::create([
           'user_id' => User::all()->count(),
       ]);

       /*
        * Abraham - BU, Ithaca, Skidmore, Union, York
        */
       $match = new MatchStudentInstitution([
           'student_id' => Student::all()->count(),
           'institution_id' => 2,
       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => Student::all()->count(),
           'institution_id' => 10,
       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => Student::all()->count(),
           'institution_id' => 12,
       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => Student::all()->count(),
           'institution_id' => 29,
           'status' => \App\Enums\General\MatchStudentInstitution::ENROLLED
       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => Student::all()->count(),
           'institution_id' => 33,
           'status' => \App\Enums\General\MatchStudentInstitution::ACCEPTED
       ]);
       $match->save();

       User::create([
           'first' => "Nic",
           'last' => "Student",
           'phone_country' => 1,
           'phone_area' => 571,
           'phone_local' => 2143085,
           'password' => bcrypt('password'),
           'email' => "gmgarrison+nic@gmail.com",
           'role' => Role::STUDENT,
           'status' => Status::ACTIVE,
       ]);

       Student::create([
           'user_id' => User::all()->count(),
       ]);

   }
}
