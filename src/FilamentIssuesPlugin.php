<?php

namespace Lightworx\FilamentIssues;

use Filament\Actions\Action;
use Filament\Contracts\Plugin;
use Filament\Facades\Filament;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use Filament\Notifications\Notification;
use Lightworx\FilamentIssues\Filament\Resources\HelpIssues\HelpIssueResource;
use Lightworx\FilamentIssues\Models\HelpDocument;
use Lightworx\FilamentIssues\Resources\HelpDocuments\HelpDocumentResource;
use Livewire\Livewire;

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
        // Register resources
        $panel->resources([
            HelpIssueResource::class,
            HelpDocumentResource::class,
        ]);

        // Register Livewire component for the modal
        Livewire::component('lightworx.filament-issues.help-modal', HelpModal::class);

        // Prepare user menu items
        $menuItems = [
            // Static Help Issues link
            Action::make('issues')
                ->label('Help Issues')
                ->icon('heroicon-o-question-mark-circle')
                ->url(fn () => route('filament.admin.resources.help-issues.index')),
        ];

        // Get current Filament page
        $currentUrl = str_replace(url('/'), '', url()->current());
        $currentPage = HelpDocument::where('slug', substr($currentUrl,1))->first();
        if ($currentPage) {
            $menuItems[] = Action::make('help')
                ->label('Help')
                ->icon('heroicon-o-question-mark-circle')
                ->action(function () use ($currentUrl) {
                    Livewire::emit('openHelpModal', $currentUrl);
                });
        }

        $panel->userMenuItems($menuItems);
    }

    public function boot(Panel $panel): void
    {
        // Mount the Livewire modal globally so it exists on all pages
        Filament::registerRenderHook(
            'panels::global',
            fn () => Livewire::mount('lightworx.filament-issues.help-modal')->html()
        );
    }

}
