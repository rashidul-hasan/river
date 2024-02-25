<?php

namespace Rashidul\River;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Rashidul\River\Commands\CacheViewFilesCommand;
use Rashidul\River\Commands\DatabaseSeederCommand;
use Rashidul\River\Commands\Generators\MakeControllerCommand;
use Rashidul\River\Commands\Generators\MakeMigrationCommand;
use Rashidul\River\Commands\Generators\MakeModelCommand;
use Rashidul\River\Commands\Generators\MakeViewFilesCommand;
use Rashidul\River\Commands\Generators\ScaffoldCommand;
use Rashidul\River\Http\Middleware\Authenticate;
use Rashidul\River\Http\Middleware\CheckRole;
use Rashidul\River\Http\Middleware\RedirectIfAuthenticated;
use Rashidul\River\Models\Admin;
use Rashidul\River\Models\Customer;
use Rashidul\River\ViewComposers\AdminSidebarViewComposer;

class RiverServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->configureAuthGuards();

        $this->configureMiddlewares();

        $this->configureRoutes();

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'river');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->publishes([
            __DIR__ . '/../public' => public_path('river'),
        ], 'river-assets');


        //viewcomposers
        View::composer('river::admin.layouts.sidebar', AdminSidebarViewComposer::class);

        //blade components
        Blade::component('river::header', 'header');

        $this->configureCommands();
    }

    private function configureAuthGuards(): void
    {
        $this->app['config']->set('auth.guards.admins', [
            'driver' => 'session',
            'provider' => 'admins',
        ]);
        $this->app['config']->set('auth.providers.admins', [
            'driver' => 'eloquent',
            'model' => Admin::class,
        ]);
        $this->app['config']->set('auth.guards.customers', [
            'driver' => 'session',
            'provider' => 'customers',
        ]);
        $this->app['config']->set('auth.providers.customers', [
            'driver' => 'eloquent',
            'model' => Customer::class,
        ]);
    }

    private function configureMiddlewares(): void
    {
        $this->app['router']->aliasMiddleware('river.auth', Authenticate::class);
        $this->app['router']->aliasMiddleware('river.guest', RedirectIfAuthenticated::class);
        $this->app['router']->aliasMiddleware('river.checkrole', CheckRole::class);
    }

    private function configureRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/site.php');
    }

    private function configureCommands(): void
    {
        $this->commands([
            CacheViewFilesCommand::class,
            DatabaseSeederCommand::class,
            MakeMigrationCommand::class,
            MakeViewFilesCommand::class,
            ScaffoldCommand::class,
            MakeControllerCommand::class,
            MakeModelCommand::class
        ]);
    }
}
