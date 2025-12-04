<?php

namespace Lightworx\FilamentIssues\Filament\HelpDocuments\Pages;

use Lightworx\FilamentIssues\Filament\HelpDocuments\HelpDocumentResource;
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

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
