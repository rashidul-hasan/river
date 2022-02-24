<?php

namespace Rashidul\River;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Rashidul\River\Commands\RiverCommand;
use Rashidul\River\Http\Middleware\AdminMiddleware;
use Rashidul\River\Http\Middleware\Authenticate;
use Rashidul\River\Http\Middleware\RedirectIfAuthenticated;
use Rashidul\River\Models\Admin;

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
//        $router = $this->app->make('Illuminate\Routing\Router');
//        $router->aliasMiddleware('name', 'MiddlewareClass');
//        $kernel->pushMiddleware('Mrcore\Modules\Wiki\Http\Middleware\AnalyzeRoute');

        $this->loadRoutesFrom(__DIR__.'/../routes/admin.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'river');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([
            __DIR__.'/../public' => public_path('river'),
        ], 'river-assets');



        /*Auth::provider('admin', function() {
            return new CustomUserProvider(new \UserAccount());
        });*/
    }
}
