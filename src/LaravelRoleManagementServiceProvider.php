<?php

namespace Pooyadch\LaravelRoleManagement;

use Illuminate\Support\ServiceProvider;

class LaravelRoleManagementServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'pooyadch');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'pooyadch');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {

            // Publishing the configuration file.
            $this->publishes([
                __DIR__.'/../config/laravelrolemanagement.php' => config_path('laravelrolemanagement.php'),
            ], 'laravelrolemanagement.config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/pooyadch'),
            ], 'laravelrolemanagement.views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/pooyadch'),
            ], 'laravelrolemanagement.views');*/
            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/pooyadch'),
            ], 'laravelrolemanagement.views');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/pooyadch'),
            ], 'laravelrolemanagement.views');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravelrolemanagement.php', 'laravelrolemanagement');

        // Register the service the package provides.
        $this->app->singleton('laravelrolemanagement', function ($app) {
            return new LaravelRoleManagement;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravelrolemanagement'];
    }
}