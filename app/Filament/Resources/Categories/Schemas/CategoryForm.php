<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->disk('public') // public disk, storage\app\public
                    ->directory('categories') // directorio donde se guardan las imagenes, storage\app\public\categories
                    ->imageEditor()
                    ->image(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
