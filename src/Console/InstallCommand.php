<?php

namespace RhysLees\ServiceBase\Console;

use Illuminate\Support\Str;
use RecursiveIteratorIterator;
use Illuminate\Console\Command;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'servicebase:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Service Base';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        //Run First
        $this->installJetstream();
        $this->installNova();
        $this->installSpark();

        $this->installConfig();
        $this->installModels();
        $this->installProviders();

        $this->installNovaTheme();

        $this->removeMigrations();
        $this->createMigrations();


        $this->info('Service Base scaffolding installed successfully.');
    }


    public function installJetstream()
    {
        $this->info('Installing Jetstream.');
        $this->callSilent('jetstream:install', ['stack' => 'livewire', '--teams' => 'true']);
        $this->info('Installed Jetstream.');
    }
    public function installNova()
    {
        $this->info('Installing Nova.');
        $this->callSilent('nova:install');
        $this->info('Installed Nova.');
    }

    public function installSpark()
    {
        $this->info('Installing Spark.');
        $this->callSilent('spark:install');
        $this->info('Installed Spark.');
    }
    
    public function installConfig()
    {
        $this->info('Installing Configs.');
        // Configuration...
        copy(__DIR__.'/../../stubs/Config/database.php', config_path('database.php'));
        copy(__DIR__.'/../../stubs/Config/nova.php', config_path('nova.php'));
        copy(__DIR__.'/../../stubs/Config/spark.php', config_path('spark.php'));
        $this->info('Installed Configs.');
    }
    
    public function installProviders()
    {
        $this->info('Installing Providers.');
        // Providers...
        copy(__DIR__.'/../../stubs/app/Providers/NovaServiceProvider.php', app_path('Providers/NovaServiceProvider.php'));
        copy(__DIR__.'/../../stubs/app/Providers/SparkServiceProvider.php', app_path('Providers/SparkServiceProvider.php'));
        $this->info('Installed Providers.');
    }

    public function installModels()
    {
        $this->info('Installing Models.');
        $this->callSilent('vendor:publish', ['--tag' => 'servicebase-models', '--force' => 'true']);

        // Models...
        copy(__DIR__.'/../../stubs/app/Models/Team.php', app_path('Models/Team.php'));
        copy(__DIR__.'/../../stubs/app/Models/TeamInvitation.php', app_path('Models/TeamInvitation.php'));
        copy(__DIR__.'/../../stubs/app/Models/Membership.php', app_path('Models/Membership.php'));
        copy(__DIR__.'/../../stubs/app/Models/User.php', app_path('Models/User.php'));
        $this->info('Installed Models.');
    }

    public function installNovaTheme()
    {
        $this->info('Installing Nova Theme.');

        // Nova Theme ...
        $this->callSilent('vendor:publish', ['--provider' => 'ManageItProLtd\NovaStyling\ThemeServiceProvider', '--tag' => 'config', '--force' => 'true']);
        $this->callSilent('vendor:publish', ['--provider' => 'ManageItProLtd\NovaStyling\ThemeServiceProvider', '--tag' => 'views', '--force' => 'true']);
        $this->callSilent('vendor:publish', ['--provider' => 'ManageItProLtd\NovaStyling\ThemeServiceProvider', '--tag' => 'styling', '--force' => 'true']);
        $this->info('Installed Nova Theme.');
    }

    public function removeMigrations()
    {
        $this->info('Removing Migrations');
        if (is_dir(database_path('migrations'))) {
            $dir = database_path('migrations');
            $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
            $files = new RecursiveIteratorIterator($it,
                        RecursiveIteratorIterator::CHILD_FIRST);
            foreach($files as $file) {
                if ($file->isDir()){
                    rmdir($file->getRealPath());
                } else {
                    unlink($file->getRealPath());
                }
            }   
            rmdir(database_path('migrations'));
        }
        if (!is_dir(database_path('migrations'))) {
            mkdir(database_path('migrations'));
        }
        $this->info('Removed Migrations');
    }

    public function createMigrations()
    {
        $this->info('Creating Migrations');
        try {
            //code...
            $this->call('cache:table');
            $this->info('Created Cache Table.');
        } catch (\Throwable $th) {
            $this->info('Skipped Creating Cache Table.');
        }

        $this->callSilent('vendor:publish', ['--tag' => 'servicebase-migrations', '--force' => 'true']);

        $this->info('Created Migrations');
    }
}
