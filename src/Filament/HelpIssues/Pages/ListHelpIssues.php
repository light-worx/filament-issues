<?php

namespace Lightworx\FilamentIssues\Filament\HelpIssues\Pages;

use Lightworx\FilamentIssues\Filament\HelpIssues\HelpIssueResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHelpIssues extends ListRecords
{
    protected static string $resource = HelpIssueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
