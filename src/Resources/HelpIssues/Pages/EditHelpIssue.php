<?php

namespace Lightworx\FilamentIssues\Filament\Resources\HelpIssues\Pages;

use Lightworx\FilamentIssues\Filament\Resources\HelpIssues\HelpIssueResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditHelpIssue extends EditRecord
{
    protected static string $resource = HelpIssueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
