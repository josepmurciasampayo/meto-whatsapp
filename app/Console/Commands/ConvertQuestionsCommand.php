<?php

namespace App\Console\Commands;

use App\Enums\General\YesNo;
use App\Enums\Student\Curriculum;
use App\Helpers;
use App\Models\Question;
use App\Models\QuestionCurriculum;
use Illuminate\Console\Command;

class ConvertQuestionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'convert:questions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move curriculum-related data to separate tables';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $enum = Curriculum::descriptions();
        foreach ($enum as $curriculum) {
                $c = new \App\Models\Curriculum();
                $c->name = $curriculum;
                $c->save();
        }
        return Command::SUCCESS;
    }
}
