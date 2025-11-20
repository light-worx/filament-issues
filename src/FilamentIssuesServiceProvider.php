<?php

namespace Lightworx\FilamentIssues;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Lightworx\FilamentIssues\Commands\InstallCommand;

class FilamentIssuesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-issues')
            ->hasConfigFile()          // config/filament-issues.php
            ->hasTranslations()        // resources/lang
            ->hasCommand(InstallCommand::class) // Spatie PackageTools registration
            ->hasMigration('create_filament_issues_tables');
    }

    public function boot(): void
    {
        parent::boot();

        // Manually register command for local symlinked development
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Lightworx\FilamentIssues\Commands\InstallCommand::class,
            ]);
        }
    }
}
