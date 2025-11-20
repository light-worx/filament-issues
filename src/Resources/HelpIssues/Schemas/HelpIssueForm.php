<?php

namespace Lightworx\FilamentIssues\Filament\Resources\HelpIssues\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class HelpIssueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category')
                    ->default('bug')
                    ->options([
                        'bug' => 'Log a fault',
                        'feature' => 'Feature request',
                        'question' => 'Ask a question'
                    ])
                    ->selectablePlaceholder(false)
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Hidden::make('user_id')
                    ->default(fn () => auth()->id())
                    ->required(),
            ]);
    }
}
