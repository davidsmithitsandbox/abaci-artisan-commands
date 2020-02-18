<?php

namespace Abaci\ArtisanCommands\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DeleteDir extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:dir {path?} {--i}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes a directory';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = $this->argument('path') ?? $this->ask('Path to Directory:');

        if (!File::isDirectory($path)) {
            $this->info('Directory does not exist. No action taken');

            return $this;
        }

        if ($this->argument('path')) {
            $this->deleteDirectory($path);

            return $this;
        }

        if ($this->confirm("Delete Directory: $path")) {
            $this->deleteDirectory($path);

            return $this;
        }

        $this->info('User Canceled. No action taken');

        return $this;
    }

    /**
     * Deletes a directory
     *
     * @param $path
     *
     * @return DeleteDir
     */
    protected function deleteDirectory($path): DeleteDir
    {
        File::deleteDirectory($path);
        $this->info("Directory Deleted: $path");

        return $this;
    }
}
