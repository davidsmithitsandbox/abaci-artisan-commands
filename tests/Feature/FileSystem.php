<?php

namespace Abaci\ArtisanCommands\Tests\Feature;

use Abaci\ArtisanCommands\ServiceProviders\ArtisanCommandsServiceProvider;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase;

class FileSystem extends TestCase
{

    protected $temp_dir = './tests/temp/';

    /** @test */
    public function makes_directory_and_deletes_a_directory(): void
    {
        $path = $this->temp_dir;
        File::deleteDirectory($path);
        $this->artisan("make:dir $path")
            ->expectsOutput('Directory created: ' . $path)
            ->assertExitCode(0);
        $this->assertTrue(File::exists($path));
        $this->artisan("delete:dir $path")
            ->expectsOutput("Directory Deleted: $path")
            ->assertExitCode(0);
        $this->assertFalse(File::exists($path));
        File::deleteDirectory($path);
    }

    protected function getPackageProviders($app): array
    {
        return [ArtisanCommandsServiceProvider::class];
    }
}