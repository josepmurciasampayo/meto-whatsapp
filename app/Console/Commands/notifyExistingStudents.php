<?php

namespace App\Console\Commands;

use App\Enums\User\Role;
use App\Mail\StudentNewPassword;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class notifyExistingStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:students';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to all existing students with link and temporary password';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $students = User::where('role', Role::STUDENT())->get();
        $total = count($students);
        $current = 1;
        foreach ($students as $student) {
            if ($current < 14 || in_array($current, [15,17,19,21,23,25,27,29,31,33,35,37,39,41,43,45,47,49,51,53,55,57,59,61,63])) {
                $current++;
                continue;
            }
            echo "\n" . $current++ . " / " . $total;
            $newPass = Str::random(8);
            $student->password = Hash::make($newPass);
            $student->save();
            Mail::to($student)->send(new StudentNewPassword($newPass, $student));
        }
        return Command::SUCCESS;
    }
}
