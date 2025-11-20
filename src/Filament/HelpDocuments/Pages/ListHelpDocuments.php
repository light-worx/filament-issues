<?php

namespace Lightworx\FilamentIssues\Filament\HelpDocuments\Pages;

use Lightworx\FilamentIssues\Filament\HelpDocuments\HelpDocumentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHelpDocuments extends ListRecords
{
    protected static string $resource = HelpDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
