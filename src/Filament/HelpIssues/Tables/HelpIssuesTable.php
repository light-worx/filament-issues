<?php

namespace Lightworx\FilamentIssues\Filament\HelpIssues\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class HelpIssuesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category'),
                TextColumn::make('description')->searchable(),
                TextColumn::make('status'),
                TextColumn::make('user.name')->label('User'),
                TextColumn::make('created_at')->since()->sortable()
            ])
            ->filters([
                SelectFilter::make('category')->label('')
                ->options([
                    'bug' => 'Log a fault',
                    'feature' => 'Feature request',
                    'question' => 'Ask a question'
                ]),
                Filter::make('hide_closed')
                ->query(fn (Builder $query): Builder => $query->where('status', '<>', 'closed'))
                ->default()
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
