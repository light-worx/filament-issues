<?php

namespace Lightworx\FilamentIssues\Resources\HelpDocuments\Pages;

use Lightworx\FilamentIssues\Resources\HelpDocuments\HelpDocumentResource;
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
