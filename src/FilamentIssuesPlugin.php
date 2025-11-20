<?php

namespace Lightworx\FilamentIssues;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use Lightworx\FilamentIssues\Filament\Resources\HelpIssues\HelpIssueResource;

class FilamentIssuesPlugin implements Plugin
{
    use EvaluatesClosures;

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public function getId(): string
    {
        return 'filament-issues';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([HelpIssueResource::class]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
