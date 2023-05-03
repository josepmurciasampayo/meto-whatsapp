<?php

namespace App\Console\Commands;

use App\Helpers;
use App\Models\Response;
use Illuminate\Console\Command;

class removeDuplicateResponses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:responseDuplicates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove duplicate responses per question';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $question_ids = Helpers::dbQueryArray('select distinct question_id from meto_responses');
        foreach ($question_ids as $question) {
            $responses = Response::where('question_id', $question['question_id']);
            $unique = array();
            foreach ($responses as $response) {
                $unique[$response->text] = $response->text;
            }
            Response::where('question_id', $question['question_id'])->delete();
            foreach ($unique as $text) {
                $r = new Response();
                $r->question_id = $question['question_id'];
                $r->text = $text;
                $r->save();
            }
        }
        return Command::SUCCESS;
    }
}
