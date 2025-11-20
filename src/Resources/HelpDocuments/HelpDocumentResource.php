<?php

namespace Lightworx\FilamentIssues\Resources\HelpDocuments;

use Lightworx\FilamentIssues\Resources\HelpDocuments\Pages\CreateHelpDocument;
use Lightworx\FilamentIssues\Resources\HelpDocuments\Pages\EditHelpDocument;
use Lightworx\FilamentIssues\Resources\HelpDocuments\Pages\ListHelpDocuments;
use Lightworx\FilamentIssues\Resources\HelpDocuments\Schemas\HelpDocumentForm;
use Lightworx\FilamentIssues\Resources\HelpDocuments\Tables\HelpDocumentsTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Lightworx\FilamentIssues\Models\HelpDocument;

class HelpDocumentResource extends Resource
{
    protected static ?string $model = HelpDocument::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return HelpDocumentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HelpDocumentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHelpDocuments::route('/'),
            'create' => CreateHelpDocument::route('/create'),
            'edit' => EditHelpDocument::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
