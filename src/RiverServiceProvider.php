<?php

namespace Rashidul\River;

use Illuminate\Support\ServiceProvider;
use Rashidul\River\Commands\RiverCommand;

class RiverServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'river');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([
            __DIR__.'/../public' => public_path('river'),
        ], 'river-assets');
    }
}
