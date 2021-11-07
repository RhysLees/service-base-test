<?php

namespace RhysLees\ServiceBase;

use Spark\Spark;
use Laravel\Nova\Nova;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\ServiceProvider;

class ServiceBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/servicebase.php' => config_path('servicebase.php')
        ], 'servicebase-config');

        $this->publishes([
            __DIR__.'/../stubs/database/migrations/' => database_path('migrations')
        ], 'servicebase-migrations');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'servicebase');

        $this->loadRoutesFrom(__DIR__.'/../routes/servicebase.php');

        Nova::resources(ServiceBase::NovaResources());
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/servicebase.php', 'servicebase'
        );

        # code...
        $this->app->singleton(ServiceBase::class, function (){
            return new ServiceBase();
        });

        $this->registerCommands();
    }

    /**
     * Register the Service Base Artisan commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\InstallCommand::class,
            ]);
        }
    }
}


