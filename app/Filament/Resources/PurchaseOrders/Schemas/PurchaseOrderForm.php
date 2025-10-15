<?php

namespace App\Filament\Resources\PurchaseOrders\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\ToggleButtons;
use Filament\Support\Enums\Operation;

class PurchaseOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('order_number')
                    ->readOnly()
                    ->hiddenOn(Operation::Create)
                    ->required(),
                Select::make('supplier_id')
                    ->label('Proveedor')
                    ->relationship('supplier', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('user_id')
                    ->label('Usuario')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                ToggleButtons::make('status')
                    ->options([
                        'pending' => 'Pendiente',
                        'ordered' => 'Ordenado',
                        'received' => 'Recibido',
                        'cancelled' => 'Cancelado',
                    ])
                    ->colors([
                        'pending' => 'gray',
                        'ordered' => 'info',
                        'received' => 'success',
                        'cancelled' => 'danger',
                    ])
                    ->icons([
                        'pending' => 'heroicon-o-clock',
                        'ordered' => 'heroicon-o-check',
                        'received' => 'heroicon-o-truck',
                        'cancelled' => 'heroicon-o-x-circle',
                    ])
                    // ->inline()
                    ->grouped()
                    ->default('pending')
                    ->required(),
                DatePicker::make('order_date')
                    ->required(),
                DatePicker::make('expected_date'),
                DatePicker::make('received_date'),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
