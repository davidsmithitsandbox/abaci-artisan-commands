<?php

namespace Abaci\ArtisanCommands\Tests\Unit;

use Abaci\ArtisanCommands\ServiceProviders\ArtisanCommandsServiceProvider;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase;

class MakeDirTest extends TestCase
{

    protected $temp_dir = './tests/temp/';

    /** @test */
    public function makes_directory(): void
    {
        $path = $this->temp_dir;
        File::deleteDirectory($path);
        $this->artisan("make:dir $path")
            ->expectsOutput('Directory created: ' . $path)
            ->assertExitCode(0);
        $this->assertTrue(File::exists($path));
        File::deleteDirectory($path);
    }

    /** @test */
    public function warns_of_existing_dir(): void
    {
        $path = $this->temp_dir;
        File::makeDirectory($path);
        $this->artisan("make:dir $path")
            ->expectsOutput('Directory already exists: ' . $path)
            ->assertExitCode(0);
        $this->assertTrue(File::exists($path));
        File::deleteDirectory($path);
    }

    /** @test */
    public function warns_of_existing_no_parameters(): void
    {
        $path = $this->temp_dir;
        File::makeDirectory($path);
        $this->artisan('make:dir')
            ->expectsQuestion('Path to Directory', $path)
            ->expectsOutput('Directory already exists: ' . $path)
            ->assertExitCode(0);
        $this->assertTrue(File::exists($path));
        File::deleteDirectory($path);
    }

    /** @test */
    public function warns_of_existing_dir_i(): void
    {
        $path = $this->temp_dir;
        File::makeDirectory($path);
        $this->artisan("make:dir $path --i")
            ->expectsQuestion('Path to Directory', $path)
            ->expectsOutput('Directory already exists: ' . $path)
            ->assertExitCode(0);
        $this->assertTrue(File::exists($path));
        File::deleteDirectory($path);
    }

    /** @test */
    public function makes_directory_no_parameters(): void
    {
        $path = $this->temp_dir;
        File::deleteDirectory($path);
        $this->artisan('make:dir')
            ->expectsQuestion('Path to Directory', $path)
            ->expectsOutput('Directory created: ' . $path)
            ->assertExitCode(0);
        $this->assertTrue(File::exists($path));
        File::deleteDirectory($path);
    }

    /** @test */
    public function makes_directory_i(): void
    {
        $path = $this->temp_dir;
        File::deleteDirectory($path);
        $this->artisan('make:dir --i')
            ->expectsQuestion('Path to Directory', $path)
            ->expectsOutput('Directory created: ' . $path)
            ->assertExitCode(0);
        $this->assertTrue(File::exists($path));
        File::deleteDirectory($path);
    }

    protected function getPackageProviders($app): array
    {
        return [ArtisanCommandsServiceProvider::class];
    }
}
