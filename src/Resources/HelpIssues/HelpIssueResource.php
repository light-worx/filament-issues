<?php

namespace Lightworx\FilamentIssues\Filament\Resources\HelpIssues;

use Lightworx\FilamentIssues\Filament\Resources\HelpIssues\Pages\CreateHelpIssue;
use Lightworx\FilamentIssues\Filament\Resources\HelpIssues\Pages\EditHelpIssue;
use Lightworx\FilamentIssues\Filament\Resources\HelpIssues\Pages\ListHelpIssues;
use Lightworx\FilamentIssues\Filament\Resources\HelpIssues\Schemas\HelpIssueForm;
use Lightworx\FilamentIssues\Filament\Resources\HelpIssues\Tables\HelpIssuesTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Lightworx\FilamentIssues\Models\HelpIssue;

class HelpIssueResource extends Resource
{
    protected static ?string $model = HelpIssue::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'description';

    public static function form(Schema $schema): Schema
    {
        return HelpIssueForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HelpIssuesTable::configure($table);
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
            'index' => ListHelpIssues::route('/'),
            'create' => CreateHelpIssue::route('/create'),
            'edit' => EditHelpIssue::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
