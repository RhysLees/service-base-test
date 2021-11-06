<?php

namespace RhysLees\ServiceBase\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

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
        $this->callSilent('vendor:publish', ['--tag' => 'servicebase-config']);
        $this->callSilent('vendor:publish', ['--tag' => 'spark-views']);
        $this->callSilent('vendor:publish', ['--tag' => 'spark-lang']);
        $this->callSilent('jetstream:install', ['stack' => 'livewire', '--teams' => '']);
        $this->callSilent('vendor:publish', ['--tag' => 'servicebase-models']);

        // Configuration...
        copy(__DIR__.'/../../config/database.php', config_path('database.php'));

        // Models...
        copy(__DIR__.'/../../stubs/app/Models/Team.php', app_path('Models/Team.php'));
        copy(__DIR__.'/../../stubs/app/Models/TeamInvitation.php', app_path('Models/TeamInvitation.php'));
        copy(__DIR__.'/../../stubs/app/Models/Membership.php', app_path('Models/Membership.php'));
        copy(__DIR__.'/../../stubs/app/Models/User.php', app_path('Models/User.php'));


        $this->info('Service Base scaffolding installed successfully.');
    }

    /**
     * Replace a given string within a given file.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $path
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }
}
