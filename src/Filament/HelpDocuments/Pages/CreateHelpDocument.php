<?php

namespace Lightworx\FilamentIssues\Filament\HelpDocuments\Pages;

use Lightworx\FilamentIssues\Filament\HelpDocuments\HelpDocumentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHelpDocument extends CreateRecord
{
    protected static string $resource = HelpDocumentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
