<?php

namespace App\Providers;

use App\Models\SiteIdenty;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $identy = SiteIdenty::all()->first();

        view()->share('identy', $identy);
    }
}
