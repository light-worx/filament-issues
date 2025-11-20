<?php

namespace Lightworx\FilamentIssues\Resources\HelpDocuments\Pages;

use Lightworx\FilamentIssues\Resources\HelpDocuments\HelpDocumentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHelpDocument extends EditRecord
{
    protected static string $resource = HelpDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
