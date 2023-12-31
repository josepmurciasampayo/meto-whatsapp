<?php

namespace App\Console\Commands\archive;

use App\Enums\User\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class verifyWhatsAppNumbers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify:whatsapp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Iterates over students with unverified numbers and checks their WhatsApp number status';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $students = DB::select('select id, phone_raw from meto_users where role = ' . Role::STUDENT() . ' and phone_whatsapp_valid = 0 and phone_raw != "";');
        foreach ($students as $student) {
            $phone = preg_replace('/\D+/', '', $student->phone_raw);
            if (strlen($phone) > 20) {
                $result = 1;
            } else {
                $result = $this->fetch($phone);
            }
            if ($result == 3) {
                continue;
            } else {
                DB::update('update meto_users set phone_whatsapp_valid = ' . $result . ' where id = ' . $student->id);
            }
        }
        return Command::SUCCESS;
    }

    public function fetch(string $number) :int
    {
        try {
            $response = Http::timeout(45)->get(config('services.watverify.url'), [
                'api_key' => config('services.watverify.key'),
                'phones' => $number,
            ])->throw();
        } catch (\Exception $e) {
            if ($e->getCode() != 200) {
                if ($e->getCode() == 429) {
                    echo "Too many requests. Aborting.\n";
                    die();
                }
                if ($e->getCode() == 503) {
                    echo "Application error. Aborting.\n";
                    die();
                }
            }
            return 1;
        }

        $status = $response->getStatusCode();
        if ($status != 200) {
            return 3;
        }

        $array = json_decode($response->body(), true);

        return ($array[0]['result'] == 'true') ? 2 : 1;
    }
}
