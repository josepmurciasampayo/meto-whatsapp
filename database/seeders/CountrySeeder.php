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
        $regions = Region::options();
        foreach ($regions as $name => $key) {
            $enum = Region::from($key);
            DB::table('enum')->insert([
                'group_id' => EnumGroup::REGION,
                'enum_id' => $key,
                'enum_value' => $name,
                'enum_desc' => Region::getText($enum),
            ]);
        }

        $subRegions = SubRegion::options();
        foreach ($subRegions as $name => $key) {
            $enum = SubRegion::from($key);
            DB::table('enum')->insert([
                'group_id' => EnumGroup::SUBREGION,
                'enum_id' => $key,
                'enum_value' => $name,
                'enum_desc' => SubRegion::getText($enum),
            ]);
        }

        $countries = Country::options();
        foreach ($countries as $name => $key) {
            $enum = Country::from($key);
            DB::table('enum_countries')->insert([
                'id' => $key,
                'two_letter' => $name,
                'name' => Country::getText($enum),
            ]);
        }

        // load countries.csv and associate all the regions and sub-regions
        $countryArray = Helpers::arrayFromCSV(database_path('seeders/countries.csv'));
        foreach ($countryArray as $id => $countryRow) {
            $country = EnumCountry::where('id', $id+1)->first();
            $country->three_letter = $countryRow['alpha-3'];
            $country->code = $countryRow['country-code'];
            $country->region = $countryRow['region-lookup'];
            $country->subregion = $countryRow['sub-region-lookup'];
            $country->region_code = $countryRow['region-code'];
            $country->subregion_code = $countryRow['sub-region-code'];
            $country->save();
        }
    }

}
