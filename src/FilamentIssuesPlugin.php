<?php

namespace Lightworx\FilamentIssues;

use Filament\Actions\Action;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
use Lightworx\FilamentIssues\Filament\HelpDocuments\HelpDocumentResource;
use Lightworx\FilamentIssues\Filament\HelpIssues\HelpIssueResource;
use Lightworx\FilamentIssues\Http\Livewire\HelpModal;
use Lightworx\FilamentIssues\Models\HelpDocument;
use Lightworx\FilamentIssues\Models\HelpIssue;
use Lightworx\FilamentIssues\Filament\Widgets\IssuesWidget;
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

        // Prepare user menu items
        $menuItems = [
            // Static Help Issues link
            Action::make('issues')
                ->label('Help Issues')
                ->badge(function (){
                    return HelpIssue::query()->where('status', 'open')->count();
                })
                ->icon('heroicon-o-question-mark-circle')
                ->url(fn () => HelpIssueResource::getUrl('index')),
            Action::make('docs')
                ->label('Documentation')
                ->icon('heroicon-o-lifebuoy')
                ->url(fn () => HelpDocumentResource::getUrl('index')),
        ];
        $panel->userMenuItems($menuItems);
        $panel->widgets([
            IssuesWidget::class
        ]);
        $panel->renderHook(
            PanelsRenderHook::GLOBAL_SEARCH_AFTER, // or USER_MENU_BEFORE/AFTER
            fn() => Blade::render('@livewire("filament-issues.help-modal")')
        );
    }

    public function boot(Panel $panel): void
    {
        Livewire::component('filament-issues.help-modal', HelpModal::class);        
    }

    protected function renderHelpIcon(): string
    {
        $helpDocument = $this->getContextualHelp();

        if (!$helpDocument) {
            return '';
        }

        return view('filament-issues::components.help-icon', [
            'helpDocument' => $helpDocument,
        ])->render();
    }

    protected function getContextualHelp(): ?HelpDocument
    {
        $currentRoute = request()->route()?->getName();

        if (!$currentRoute) {
            return null;
        }

        // Try exact route match first
        $helpDoc = HelpDocument::where('slug', $currentRoute)
            ->where('is_published', true)
            ->first();
        if ($helpDoc) {
            return $helpDoc;
        }

        // Try partial matching
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

    public static function getFilamentRouteNames(): array
    {
        return collect(app('router')->getRoutes()->getRoutes())
            ->map(fn ($route) => $route->getName())
            ->filter() // remove null names
            ->unique()
            ->sort()
            ->values()
            ->mapWithKeys(fn ($name) => [$name => $name])
            ->toArray();
    }

}
