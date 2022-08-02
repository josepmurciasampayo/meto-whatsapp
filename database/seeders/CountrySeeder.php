<?php

namespace Database\Seeders;

use App\Enums\EnumGroup;
use App\Enums\Country\Country;
use App\Enums\Country\Region;
use App\Enums\Country\SubRegion;
use App\Helpers;
use App\Models\EnumCountry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // load countries.csv and associate all the regions and sub-regions
        $countryArray = Helpers::arrayFromCSV(database_path('seeders/countries.csv'));
        foreach ($countryArray as $id => $countryRow) {
            $region = Region::lookup($countryRow['region']);
            $subRegionStr = str_replace("-", "", $countryRow['sub-region']);
            $subRegion = SubRegion::lookup($subRegionStr);
            DB::insert("
                insert into meto_enum_countries (name, two_letter, three_letter, code, region, subregion, region_code, subregion_code)
                values(
                       '" . addslashes($countryRow['name']) . "',
                       '" . $countryRow['alpha-2'] . "',
                       '" . $countryRow['alpha-3'] . "',
                       " . $countryRow['country-code'] . ",
                       " . $region() . ",
                       " . $subRegion() . ",
                       " . $countryRow['region-code'] . ",
                       " . $countryRow['sub-region-code'] . "
                );
                ");
        }
    }

}
