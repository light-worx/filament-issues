<?php

namespace Lightworx\FilamentIssues\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filament-issues:install';

    /**
     * The console command description.
     *
     * @var string
     */
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
        $this->callSilent('vendor:publish', ['--tag' => 'tags-migrations']);

        $this->info('Filament Issues was installed successfully.');
        return 0;
    }
}
