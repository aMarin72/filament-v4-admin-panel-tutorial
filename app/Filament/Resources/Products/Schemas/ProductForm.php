<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Support\Enums\Operation;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('sku')
                    ->label('SKU')
                    ->required()
                    ->readOnly()
                    ->hiddenOn(Operation::Create), // ver app\Models\Product.php, protected static function boot()
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('category_id')
                    ->label('Categoría')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('supplier_id')
                    ->label('Proveedor')
                    ->relationship('supplier', 'name')
                    ->searchable()
                    ->preload(),
                TextInput::make('purchase_price')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('selling_price')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('current_stock')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('minimum_stock')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('unit')
                    ->required()
                    ->default('pcs'),
                TextInput::make('barcode')
                    ->label('Código de barras')
                    ->readOnly()
                    ->hiddenOn(Operation::Create),
                FileUpload::make('image')
                    ->disk('public') // public disk, storage\app\public
                    ->directory('products') // directorio donde se guardan las imagenes, storage\app\public\products
                    ->imageEditor()
                    ->columnSpanFull()
                    ->image(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
