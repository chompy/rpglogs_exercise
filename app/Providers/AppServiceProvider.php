<?php

namespace App\Providers;

use App\Connectors\FFXIVLodestoneConnector;
use App\Connectors\RPGLogsConnector;
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
        $this->app->singleton(
            FFXIVLodestoneConnector::class,
            function($app) {
                return new FFXIVLodestoneConnector();
            }
        );
    }

}
