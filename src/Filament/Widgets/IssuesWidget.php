<?php

namespace Lightworx\FilamentIssues\Filament\Widgets;

use Filament\Actions\Action;
use Filament\Widgets\Widget;
use Lightworx\FilamentIssues\Models\HelpIssue;

class IssuesWidget extends Widget
{
    protected string $view = 'filament-issues::filament.widgets.issues-widget';

    protected int | string | array $columnSpan = 'full';

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
        if ((auth()->user()->id==1) or auth()->user()->can('View help issues')) {
            return HelpIssue::where('status', 'open')->orWhere('status','busy')->exists();
        } else {
            return false;   
        }
    }
}