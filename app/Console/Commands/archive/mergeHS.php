<?php

namespace App\Console\Commands\archive;

use App\Helpers;
use App\Models\HighSchool;
use Illuminate\Console\Command;

class mergeHS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'highschools:merge';

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
        $indexedByName = array();
        $highschools = HighSchool::all();
        foreach ($highschools as $hs) {
            if ($hs->name != trim($hs->name)) {
                $hs->name = trim($hs->name);
                $hs->save();
            }
        }

        foreach ($highschools as $hs) {
            if (!isset($indexedByName[$hs->name])) {
                $indexedByName[$hs->name] = array();
            }
            $indexedByName[$hs->name][] = $hs;
        }

        foreach ($indexedByName as $name => $highschools) {
            if (count($highschools) > 1) {
                foreach ($highschools as $hs) {
                    $oldIDs[$name][] = $hs->id;
                }
                $ids = implode(",", $oldIDs[$name]);

                $new = $highschools[0]->replicate();
                $new->save();

                Helpers::dbUpdate('
                    update meto_user_high_schools set highschool_id = ' . $new->id . ' where highschool_id in (' . $ids . ');
                ');
                Helpers::dbUpdate('
                    delete from meto_high_schools where id in (' . $ids . ');
                ');
            }

            foreach ($highschools as $hs) {
                if (!isset($indexedByName[$hs->name])) {
                    $indexedByName[$hs->name] = array();
                }
                $indexedByName[$hs->name][] = $hs;
            }
        }


        return Command::SUCCESS;
    }
}
