<?php

namespace Lightworx\FilamentIssues\Filament\HelpDocuments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HelpDocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->label('Page route')
                    ->required(),
                Textarea::make('help_text')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_published')
                    ->label('Published?')
            ]);
    }
}
