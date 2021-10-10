<?php

namespace App\Providers;

use App\Services\RPGLogsConnector;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            RPGLogsConnector::class,
            function($app) {
                return new RPGLogsConnector(config('services.rpglogs'));
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
