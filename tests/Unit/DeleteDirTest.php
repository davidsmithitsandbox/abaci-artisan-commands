<?php

namespace Abaci\ArtisanCommands\Tests\Unit;

use Abaci\ArtisanCommands\ServiceProviders\ArtisanCommandsServiceProvider;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase;

class DeleteDirTest extends TestCase
{
    protected $temp_dir = './tests/temp';

    /** @test */
    public function deletes_a_directory(): void
    {
        $path = $this->temp_dir;
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $this->artisan("delete:dir $path")
            ->expectsOutput("Directory Deleted: $path")
            ->assertExitCode(0);

        $this->assertFalse(File::exists($this->temp_dir));

        File::deleteDirectory($path);
    }

    /** @test */
    public function warns_of_invalid_directory(): void
    {
        $path = $this->temp_dir;
        if (!File::exists($path)) {
            File::deleteDirectory($path);
        }

        $this->artisan("delete:dir $path")
            ->expectsOutput('Directory does not exist. No action taken')
            ->assertExitCode(0);
    }

    /** @test */
    public function warns_of_invalid_directory_no_parameters(): void
    {
        $path = $this->temp_dir;
        if (!File::exists($path)) {
            File::deleteDirectory($path);
        }

        $this->artisan('delete:dir')
            ->expectsQuestion('Path to Directory:', $path)
            ->expectsOutput('Directory does not exist. No action taken')
            ->assertExitCode(0);
    }

    /** @test */
    public function deletes_a_directory_no_parameters_yes(): void
    {
        $path = $this->temp_dir;
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $this->artisan('delete:dir')
            ->expectsQuestion('Path to Directory:', $path)
            ->expectsQuestion("Delete Directory: $path", 'y')
            ->expectsOutput("Directory Deleted: $path")
            ->assertExitCode(0);

        $this->assertFalse(File::exists($path));

        File::deleteDirectory($path);
    }

    /** @test */
    public function warns_of_invalid_directory_i(): void
    {
        $path = $this->temp_dir;
        if (!File::exists($path)) {
            File::deleteDirectory($path);
        }

        $this->artisan('delete:dir')
            ->expectsQuestion('Path to Directory:', $path)
            ->expectsOutput('Directory does not exist. No action taken')
            ->assertExitCode(0);
    }

    /** @test */
    public function deletes_a_directory_i_yes(): void
    {
        $path = $this->temp_dir;
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $this->artisan('delete:dir')
            ->expectsQuestion('Path to Directory:', $path)
            ->expectsQuestion("Delete Directory: $path", 'y')
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
