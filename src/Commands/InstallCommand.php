<?php

namespace Lightworx\FilamentIssues\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'filament-issues:install';
    protected $description = 'Install the Filament Issues package';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->comment('Publishing Package Configuration...');
        $this->callSilent('vendor:publish', ['--tag' => 'filament-issues-config']);

        $this->comment('Publishing Filament Issues Migrations...');
        $this->callSilent('vendor:publish', ['--tag' => 'filament-issues-migrations']);
        $this->callSilent('migrate');
        $this->info('Filament Issues was installed successfully.');
        return 0;
    }
}
