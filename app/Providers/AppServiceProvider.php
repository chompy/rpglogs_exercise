<?php

namespace App\Providers;

use App\Services\RPGLogsConnector;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    
    /**
     * {@inheritDoc}
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

}
