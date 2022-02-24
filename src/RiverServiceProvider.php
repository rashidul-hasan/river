<?php

namespace Rashidul\River;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Rashidul\River\Http\Middleware\Authenticate;
use Rashidul\River\Http\Middleware\RedirectIfAuthenticated;
use Rashidul\River\Models\Admin;
use Rashidul\River\ViewComposers\AdminSidebarViewComposer;

class RiverServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //custom auth provider
        $this->app['config']->set('auth.guards.admins', [
            'driver' => 'session',
            'provider' => 'admins',
        ]);
        $this->app['config']->set('auth.providers.admins', [
            'driver' => 'eloquent',
            'model' => Admin::class,
        ]);

        //add custom middleware
        $this->app['router']->aliasMiddleware('river.auth', Authenticate::class);
        $this->app['router']->aliasMiddleware('river.guest', RedirectIfAuthenticated::class);

        $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'river');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([
            __DIR__.'/../public' => public_path('river'),
        ], 'river-assets');


        //viewcomposers
        View::composer('river::admin.layouts.sidebar', AdminSidebarViewComposer::class);

    }
}
