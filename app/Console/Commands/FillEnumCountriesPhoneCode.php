<?php

namespace App\Console\Commands;

use App\Models\EnumCountry;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FillEnumCountriesPhoneCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fill-enum-countries-phone-code';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fills enum_countries table\'s phone_code column with the appropriate country code.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $countries = $this->getCountries();

        DB::transaction(function () use ($countries) {
            foreach ($countries as $country) {
                $existing = EnumCountry::where('two_letter', $country['country_code'])->first();

                if ($existing) {
                    $existing->update([
                        'phone_code' => $country['phone_code']
                    ]);
                }
            }
        });
    }

    private function getCountries()
    {
        $stream_context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false
            ]
        ]);

        $jsonFile = file_get_contents(url('js/json/countries.json'), false, $stream_context);

        return json_decode($jsonFile, true);
    }
}
