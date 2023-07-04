<?php

namespace App\Console\Commands;

use App\Helpers;
use App\Models\Equivalency;
use Illuminate\Console\Command;

class importEquivalencyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:equivalency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Equivalency::truncate();
        $equivalencies = Helpers::arrayFromCSV(resource_path('data/equivalency.csv'));
        foreach ($equivalencies as $e) {
            $this->import($e);
        }
        return Command::SUCCESS;
    }

    public function import(array $equivalency): void
    {
        $e = new Equivalency();
        $e->curriculum_id = $equivalency['curriculum_id'];
        $e->score_type = $equivalency['score_type'];
        $e->score = $equivalency['score'];
        $e->percentile = $equivalency['percentile'];
        $e->save();
    }
}
