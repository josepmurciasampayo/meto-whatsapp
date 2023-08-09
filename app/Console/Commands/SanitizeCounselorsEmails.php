<?php

namespace App\Console\Commands;

use App\Enums\User\Role;
use App\Enums\User\Status;
use App\Models\HighSchool;
use App\Models\Joins\UserHighSchool;
use App\Models\User;
use Illuminate\Console\Command;

class SanitizeCounselorsEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'counselor:sanitize-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sanitizes the counselors\' emails on the database.';

    /**
     * The high school of the existing user
     *
     * @var HighSchool
     */
    protected UserHighSchool $userHighSchool;

    /**
     * The users that are duplicates
     *
     * @var array
     */
    protected array $duplicates = [];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get all the counselors
        $counselors = User::where('role', Role::COUNSELOR)->get();

        foreach ($counselors as $counselor) {
            if ($counselor->highSchool) {
                $this->userHighSchool = UserHighSchool::where('user_id', $counselor->id)->first();
                // Check if the email contains a comma
                if (str_contains($counselor->email, ',')) {
                    // If it does, that means we have to emails, so we will keep the first
                    // then remove the second and create a dedicated user for it
                    $emails = explode(',', $counselor->email);

                    if ($this->existingCounselorIsNotDuplicate($emails[0]) && $this->counselorIsAbleToBeCreated($emails[1])) {
                        // Keep one email for the existing user (which is the first one)
                        $this->updateExistingCounselorEmail($counselor, $emails[0]);

                        // Create a new user for the second email
                        $this->createNewUser($counselor, $emails[1]);
                    }
                }
            }
        }

        dd($this->duplicates);
    }

    /**
     * Update the existing counselor email after splitting
     *
     * @param User $counselor
     * @param string $email
     * @return void
     */
    private function updateExistingCounselorEmail(User $counselor, string $email)
    {
        $existingUser = User::where('email', $email)->first();

        if (!$existingUser) {
            $counselor->update([
                'email' => $email
            ]);
        }
    }

    /**
     * Create a new user with the same information as the existing one
     *
     * @param User $user
     * @param string $email
     * @return User
     */
    private function createNewUser(User $user, string $email)
    {
        // Create a new user
        $user = (new User())->create([
            'email' => $email,
            'title' => $user->title,
            'role' => Role::COUNSELOR,
            'status' => Status::ACTIVE
        ]);

        // Attach the created user to a high school
        (new UserHighSchool())->create([
            'user_id' => $user->id,
            'highschool_id' => $this->userHighSchool->highschool_id,
            'role' => $this->userHighSchool->role,
            'status' => $this->userHighSchool->status,
            'sub_email' => $this->userHighSchool->sub_email
        ]);

        return $user;
    }

    /**
     * Check if the existing counselor (first email) is not duplicate
     * Report them if they exist
     *
     * @param string $email
     * @return bool
     */
    private function existingCounselorIsNotDuplicate(string $email)
    {
        $user = User::where('email', $email)->first();

        if ($user && ($highSchool = UserHighSchool::where('user_id', $user->id)->first()) && $highSchool->highschool_id !== $this->userHighSchool->highschool_id) {
            $this->reportDuplicate($user, $email, 1);
        }

        return !$user;
    }

    /**
     * Check if the counselor is able to be created
     *
     * @param string $email
     * @return bool
     */
    private function counselorIsAbleToBeCreated(string $email)
    {
        $user = User::where('email', $email)->first();

        if ($user && ($highSchool = UserHighSchool::where('user_id', $user->id)->first()) && $highSchool->highschool_id !== $this->userHighSchool->highschool_id) {
            $this->reportDuplicate($user, $email, 2);
        }

        return !$user;
    }

    /**
     * Report duplicates users
     *
     * @param User $user
     * @param $email
     * @param $emailNumber
     * @return void
     */
    protected function reportDuplicate(User $user, $email, $emailNumber)
    {
        $duplicates = User::where('email', 'LIKE', "%$email%")->get()->pluck('email');

        $report = [
            'user_id' => $user->id,
            'email' => $user->email,
            'email_index' => $emailNumber === 1 ? 'First' : 'Second',
            'first_user' => $duplicates[0],
            'second_user' => $duplicates[1],
            'note' => 'User is duplicated and not tied to the same high school.'
        ];

        $this->duplicates[] = $report;
    }
}
