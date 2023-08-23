<?php

namespace App\Console\Commands;

use App\Helpers;
use App\Models\Equivalency;
use Illuminate\Console\Command;

class ImportEquivalencyCommand extends Command
{
    protected $signature = 'app:import-equivalency';

    protected $description = 'Command description';

    public function handle()
    {
        Equivalency::truncate();

        // $this->importFirstSet();

        $this->importExtended();
    }

    public function importExtended(): void
    {
        $summary = [];
        $equivalencies = Helpers::arrayFromCSV(resource_path('data/equivalency_new.csv'));
        foreach ($equivalencies as $e) {
            $this->import($e);
            $summary[$e['curriculum_id']][$e['score_type']] = 1;
        }
        dd($summary);
    }

    public function importFirstSet(): void
    {
        $equivalencies = Helpers::arrayFromCSV(resource_path('data/equivalency_update.csv'));
        foreach ($equivalencies as $e) {
            $this->import($e);
        }
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
