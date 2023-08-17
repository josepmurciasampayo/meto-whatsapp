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
    protected $signature = 'app:sanitize-counselor-emails';

    protected $description = 'Sanitizes the counselors\' emails on the database.';

    protected array $duplicates = [];

    public function handle()
    {
        // Get all the counselors with commas in their emails
        $counselors = User::where('role', Role::COUNSELOR)->where('email', 'like', '%,%')->get();

        foreach ($counselors as $counselor) {
            $joins = UserHighSchool::where('user_id', $counselor->id)->get();
            $emails = explode(',', $counselor->email);

            foreach ($emails as $email) {
                // check for dupe
                $existingUser = User::where('email', $email)->first() ?? $this->createNewUser($counselor, $email);

                foreach ($joins as $join) {
                    $this->associateHS($existingUser, $join);
                }
            }

            foreach ($joins as $join) {
                $join->delete();
            }
            $counselor->delete();
        }
    }

    private function createNewUser(User $user, string $email, UserHighSchool $userHighSchool = null): User
    {
        // Create a new user
        $new = (new User())->create([
            'email' => $email,
            'title' => $user->title,
            'role' => Role::COUNSELOR,
            'status' => Status::ACTIVE
        ]);

        if ($userHighSchool) {
            $this->associateHS($new, $userHighSchool);
        }

        return $new;
    }

    private function associateHS(User $user, UserHighSchool $userHighSchool): void
    {
        $existing = UserHighSchool::where('user_id', $user->id)->where('highschool_id', $userHighSchool->highschool_id)->first();

        if (!$existing) {
            (new UserHighSchool())->create([
                'user_id' => $user->id,
                'highschool_id' => $userHighSchool->highschool_id,
                'role' => $userHighSchool->role,
                'status' => $userHighSchool->status,
                'sub_email' => $userHighSchool->sub_email
            ]);
        }
    }
}
