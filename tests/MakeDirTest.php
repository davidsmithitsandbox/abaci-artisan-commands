<?php

namespace Abaci\ArtisanCommands\Tests;

use Abaci\ArtisanCommands\ServiceProviders\ArtisanCommandsServiceProvider;
use Illuminate\Filesystem\Filesystem;
use Orchestra\Testbench\TestCase;

class MakeDirTest extends TestCase
{
    protected $temp_dir = './temp/';

    protected function getPackageProviders($app): array
    {
        return [ArtisanCommandsServiceProvider::class];
    }

    /** @test */
    public function makes_directory(): void
    {
        $path       = $this->temp_dir;
        $Filesystem = new Filesystem();
        $Filesystem->deleteDirectory($path);
        $this->artisan("make:dir $path")
            ->expectsOutput('Directory created: ' . $path)
            ->assertExitCode(0);
        $Filesystem->deleteDirectory($path);
    }

    /** @test */
    public function warns_of_existing_dir(): void
    {
        $path       = $this->temp_dir;
        $Filesystem = new Filesystem();
        $Filesystem->makeDirectory($path);
        $this->artisan("make:dir $path")
            ->expectsOutput('Directory already exists: ' . $path)
            ->assertExitCode(0);
        $Filesystem->deleteDirectory($path);
    }

    /** @test */
    public function makes_directory_i(): void
    {
        $path       = $this->temp_dir;
        $Filesystem = new Filesystem();
        $Filesystem->deleteDirectory($path);
        $this->artisan("make:dir $path --i")
            ->expectsQuestion('Path to Directory', $path)
            ->expectsOutput('Directory created: ' . $path)
            ->assertExitCode(0);
        $Filesystem->deleteDirectory($path);
    }

    /** @test */
    public function warns_of_existing_dir_i(): void
    {
        $path       = $this->temp_dir;
        $Filesystem = new Filesystem();
        $Filesystem->makeDirectory($path);
        $this->artisan("make:dir $path --i")
            ->expectsQuestion('Path to Directory', $path)
            ->expectsOutput('Directory already exists: ' . $path)
            ->assertExitCode(0);
        $Filesystem->deleteDirectory($path);
    }
}
