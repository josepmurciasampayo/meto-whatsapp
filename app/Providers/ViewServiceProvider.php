<?php

namespace App\Providers;

use App\View\Composers\CountriesComposer;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', CountriesComposer::class);
    }
}
