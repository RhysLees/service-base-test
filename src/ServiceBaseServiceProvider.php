<?php

namespace RhysLees\ServiceBase;

use Spark\Spark;
use Laravel\Nova\Nova;
use Illuminate\Support\ServiceProvider;

class ServiceBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/' => config_path(''), 'servicebase-config'
        ], 'servicebase-config');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'servicebase');

        $this->loadRoutesFrom(__DIR__.'/../routes/servicebase.php');

        Nova::resources(ServiceBase::NovaResources());
    }

    public function register()
    {
        Spark::ignoreMigrations();

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


