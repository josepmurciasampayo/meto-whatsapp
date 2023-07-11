<?php

namespace App\Console\Commands\archive;

use App\Helpers;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ProcessWhatsAppCSCV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:processCSV';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'One-time command to process WhatsApp messages with missed replies';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $toReviewLater = array();
        $n = 0;
        $messages = Helpers::arrayFromCSV(resource_path('replies.csv'));
        foreach ($messages as $message) {
            if (strtolower($message['body']) == "yes" && $message['direction'] == "inbound") {
                $this->process($message);
            } else if ($message['direction'] == "inbound") {
                $toReviewLater[] = $message;
            }
        }

        Helpers::CSVfromArray($toReviewLater, resource_path('repliesToReview.csv'));
        return Command::SUCCESS;
    }

    public function process(array $message) :void
    {
        print_r($message);
        $response = Http::post(
            "https://app.meto-intl.org/api/chat",
            [
                'From' => $message['from'],
                'Body' => $message['body'],
            ]
        );
        print_r($response);
    }

}
