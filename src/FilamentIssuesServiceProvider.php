<?php

namespace Lightworx\FilamentIssues;

use Illuminate\Support\ServiceProvider;
use Lightworx\FilamentIssues\Models\HelpDocument;

class FilamentIssuesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/filament-issues.php', 'filament-issues');
        $this->publishes([
            __DIR__ . '/Config/filament-issues.php' => config_path('filament-issues.php'),
        ], 'config');
        $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');
        $this->loadViewsFrom(__DIR__.'/Resources/views', 'filament-issues');
        if (file_exists($file = __DIR__ . '/helpers.php')) {
            require_once $file;
        }
    }

    /**
     * Return the contextual help document for the current route.
     */
    protected function getContextualHelp(): ?HelpDocument
    {
        $currentRoute = request()->route()?->getName();

        if (!$currentRoute) {
            return null;
        }

        // Exact match
        $helpDoc = HelpDocument::where('slug', $currentRoute)
            ->where('is_published', true)
            ->first();

        if ($helpDoc) {
            return $helpDoc;
        }

        // Partial matching: last 1-3 segments of route
        $routeParts = explode('.', $currentRoute);
        $slugPatterns = [
            implode('.', array_slice($routeParts, -2)),
            implode('.', array_slice($routeParts, -3)),
            end($routeParts),
        ];

        foreach ($slugPatterns as $pattern) {
            $helpDoc = HelpDocument::where('slug', $pattern)
                ->where('is_published', true)
                ->first();
            if ($helpDoc) {
                return $helpDoc;
            }
        }

        return null;
    }
}
