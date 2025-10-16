<?php

namespace App\Filament\Resources\StockMovements\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\ToggleButtons;

class StockMovementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_id')
                    ->label('Producto')
                    ->relationship('product', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                // Ver app\Filament\Resources\StockMovements\Pages\CreateStockMovement.php, para ver como se setea el user_id
                // Select::make('user_id')
                //     ->label('Usuario')
                //     ->relationship('user', 'name')
                //     ->searchable()
                //     ->default(auth()->id())
                //     ->preload()
                //     ->required()
                       // si esta deshabilitado, no se envia el valor al servidor con dehydrated() coseguimos que se envie
                //     ->dehydrated()
                //     ->disabled(),
                ToggleButtons::make('type')
                    ->options([
                        'in' => 'En Stock',
                        'out' => 'Fuera de Stock',
                    ])
                    ->colors([
                        'in' => 'success',
                        'out' => 'danger',
                    ])
                    ->inline()
                    ->required(),
                TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                TextInput::make('previous_stock')
                    ->required()
                    ->numeric(),
                TextInput::make('new_stock')
                    ->required()
                    ->numeric(),
                Textarea::make('reason')
                    ->rows(3)
                    ->required(),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
                DateTimePicker::make('movement_date')
                    ->required()
                    ->default(now()),
            ]);
    }
}
