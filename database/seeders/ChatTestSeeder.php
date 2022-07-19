<?php

namespace Database\Seeders;

use App\Enums\Chat\Chat;
use App\Enums\User\{Role, Status, Consent, Verified};

use App\Models\Chat\MessageState;
use App\Models\MatchStudentInstitution;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class ChatTestSeeder extends Seeder
{
   public function run()
   {
       /*
         * create student test accounts and matches
         */

       $userID = User::all()->count();
       $studentID = 1;

       User::create([
           'id' => ++$userID,
           'first' => "Greg",
           'last' => "Student" . $userID,
           'phone_country' => 1,
           'phone_area' => 571,
           'phone_local' => 2143085,
           'password' => bcrypt('password'),
           'email' => "gmgarrison+student@gmail.com",
           'role' => Role::STUDENT,
           'status' => Status::ACTIVE,
           'phone_verified' => Verified::VERIFIED,
           'whatsapp_consent' => Consent::CONSENT,
       ]);

       Student::create([
           'id' => $studentID,
           'user_id' => $userID++,
       ]);

       /*
        * Greg - BU, Carleton, Hope, Trinity
        */
       $match = new MatchStudentInstitution([
           'student_id' => $studentID,
           'institution_id' => 2,
           'status' => \App\Enums\General\MatchStudentInstitution::DENIED
       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => $studentID,
           'institution_id' => 4,
           'status' => \App\Enums\General\MatchStudentInstitution::ACCEPTED
       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => $studentID,
           'institution_id' => 8,
           'status' => \App\Enums\General\MatchStudentInstitution::APPLIED
       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => $studentID,
           'institution_id' => 21,
       ]);
       $match->save();



       User::create([
           'id' => $userID,
           'first' => "Ryan",
           'last' => "Student" . $userID,
           'phone_country' => 1,
           'phone_area' => 571,
           'phone_local' => 2143085,
           'password' => bcrypt('password'),
           'email' => "gmgarrison+ryan@gmail.com",
           'role' => Role::STUDENT,
           'status' => Status::ACTIVE,
           'phone_verified' => Verified::VERIFIED,
       ]);

       Student::create([
           'id' => ++$studentID,
           'user_id' => $userID++,
       ]);

       /*
        * Ryan - Ithaca, Pomona, Union, Worcester, York
        */
       $match = new MatchStudentInstitution([
           'student_id' => $studentID,
           'institution_id' => 10,
           'status' => \App\Enums\General\MatchStudentInstitution::DENIED
       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => $studentID,
           'institution_id' => 24,
       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => $studentID,
           'institution_id' => 29,
       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => $studentID,
           'institution_id' => 31,
       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => $studentID,
           'institution_id' => 33,

       ]);
       $match->save();



       User::create([
           'id' => $userID,
           'first' => "Abraham",
           'last' => "Student" . $userID,
           'phone_country' => 1,
           'phone_area' => 571,
           'phone_local' => 2143085,
           'password' => bcrypt('password'),
           'email' => "gmgarrison+abe@gmail.com",
           'role' => Role::STUDENT,
           'status' => Status::ACTIVE,
           'whatsapp_consent' => Consent::CONSENT,
       ]);

       Student::create([
           'id' => ++$studentID,
           'user_id' => $userID++,
       ]);

       /*
        * Abraham - BU, Ithaca, Skidmore, Union, York
        */
       $match = new MatchStudentInstitution([
           'student_id' => $studentID,
           'institution_id' => 2,

       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => $studentID,
           'institution_id' => 10,

       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => $studentID,
           'institution_id' => 12,

       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => $studentID,
           'institution_id' => 29,
           'status' => \App\Enums\General\MatchStudentInstitution::ENROLLED
       ]);
       $match->save();

       $match = new MatchStudentInstitution([
           'student_id' => $studentID,
           'institution_id' => 33,
           'status' => \App\Enums\General\MatchStudentInstitution::ACCEPTED
       ]);
       $match->save();

       User::create([
           'id' => $userID,
           'first' => "Nic",
           'last' => "Student" . $userID,
           'phone_country' => 1,
           'phone_area' => 571,
           'phone_local' => 2143085,
           'password' => bcrypt('password'),
           'email' => "gmgarrison+nic@gmail.com",
           'role' => Role::STUDENT,
           'status' => Status::ACTIVE,
       ]);

       Student::create([
           'id' => ++$studentID,
           'user_id' => $userID++,
       ]);


       /*
        * Setup testchats for test students
        */
       $userCount = User::all()->count();

       MessageState::startMessage($userCount--, Chat::ENDOFCYCLE());
       //MessageState::startMessage($userCount--, Chat::ENDOFCYCLE());
       //MessageState::startMessage($userCount--, Chat::ENDOFCYCLE());
   }
}
