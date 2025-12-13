<?php

namespace Lightworx\FilamentIssues\Filament\Widgets;

use Filament\Actions\Action;
use Filament\Widgets\Widget;
use Lightworx\FilamentIssues\Models\HelpIssue;

class IssuesWidget extends Widget
{
    protected string $view = 'filament-issues::filament.widgets.issues-widget';

    public $issues;

    protected function getHeaderAction(): ?Action
    {
        return Action::make('View Issues')->url(route('filament.admin.resources.help-issues.index'));
    }

    public function mount()
    {
        $this->issues=HelpIssue::where('status','<>','closed')->get();
    }

    public static function canView(): bool
    {
        return HelpIssue::where('status', 'open')->orWhere('status','busy')->exists();
    }
}