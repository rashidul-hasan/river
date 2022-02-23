<?php

namespace Rashidul\River;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Rashidul\River\Commands\RiverCommand;

class RiverServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('river')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_river_table')
            ->hasCommand(RiverCommand::class);
    }
}
