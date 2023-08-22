<?php

namespace App\View\Composers;

use App\Models\EnumCountry;
use Illuminate\View\View;

class CountriesComposer
{
    public static $countries = null;
    public static $phoneCountries = null;

    public function __construct()
    {
        if (is_null(self::$countries)) {
            $countries = EnumCountry::get(['id', 'name', 'code']);
            foreach ($countries as $country) {
                self::$countries[] = $country->name;
            }
        }

        if (is_null(self::$phoneCountries)) {
            foreach ($countries as $country) {
                self::$phoneCountries[$country->id] = $country->name;
            }
        }
    }

    /**
     * Make the countries variable available once the view is called
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('countries', self::$countries);
        $view->with('phoneCountries', self::$phoneCountries);
    }
}
