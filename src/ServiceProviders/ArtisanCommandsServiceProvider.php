<?php

namespace Abaci\ArtisanCommands\ServiceProviders;

use Abaci\ArtisanCommands\Console\Commands\DeleteDir;
use Abaci\ArtisanCommands\Console\Commands\MakeDir;
use Illuminate\Support\ServiceProvider;

class ArtisanCommandsServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            // Registering package commands.
            $this->commands(
                [
                    MakeDir::class,
                    DeleteDir::class
                ]
            );
        }
    }
}
