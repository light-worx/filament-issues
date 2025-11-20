<?php

namespace Lightworx\FilamentIssues;

use Illuminate\Support\Facades\Log;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Lightworx\FilamentIssues\Commands\InstallCommand;

class FilamentIssuesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-issues')
            ->hasConfigFile()
            ->hasTranslations()
            ->hasCommand(InstallCommand::class)
            ->hasMigration('create_filament_issues_tables');
    }

    public function boot(): void
    {
        Log::info('Filament Issues provider loaded');
    }
}
