<?php

namespace Abaci\ArtisanCommands\Tests\Feature;

use Abaci\ArtisanCommands\ServiceProviders\ArtisanCommandsServiceProvider;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase;

class FileSystemTest extends TestCase
{

    protected $temp_dir = './tests/temp/';

    /** @test */
    public function makes_directory_and_deletes_a_directory(): void
    {
        $path = $this->temp_dir;

        if (!File::isDirectory($path)) {
            File::deleteDirectory($path);
        }

        $this->assertDirectoryNotExists($path);

        $this->artisan("make:dir $path")
            ->expectsOutput('Directory created: ' . $path)
            ->assertExitCode(0);

        $this->assertDirectoryExists($path);

        $this->artisan("delete:dir $path")
            ->expectsOutput("Directory Deleted: $path")
            ->assertExitCode(0);

        $this->assertDirectoryNotExists($path);
    }

    protected function getPackageProviders($app): array
    {
        return [ArtisanCommandsServiceProvider::class];
    }
}
