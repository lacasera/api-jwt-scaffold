<?php

namespace Lacasera\ApiJwtScaffold;

use Illuminate\Support\ServiceProvider;
use Lacasera\ApiJwtScaffold\Console\ScaffoldCommand;
use Lacasera\ApiJwtScaffold\Installers\InstallerInterface;
use Lacasera\ApiJwtScaffold\Installers\LaravelPassportInstaller;
use Lacasera\ApiJwtScaffold\Installers\TymonJwtInstaller;

class ApiJwtScaffoldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('api-jwt-scaffold.php'),
            ], 'config');

            // Registering package commands.
             $this->commands([ScaffoldCommand::class]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'api-jwt-scaffold');

        // Register the main class to use with the facade
        $this->app->singleton('api-jwt-scaffold', function () {
            return new ApiJwtScaffold;
        });

        $this->app->bind(InstallerInterface::class, LaravelPassportInstaller::class);
        $this->app->bind(InstallerInterface::class, TymonJwtInstaller::class);
    }
}
