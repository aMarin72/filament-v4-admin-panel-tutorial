<?php

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Filament\Resources\Products\Pages\EditProduct;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Filament\Resources\Products\Pages\ViewProduct;
use App\Filament\Resources\Products\Schemas\ProductForm;
use App\Filament\Resources\Products\Schemas\ProductInfolist;
use App\Filament\Resources\Products\Tables\ProductsTable;
use App\Models\Product;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cube;

    protected static ?string $recordTitleAttribute = 'name'; // recordTitleAttribute es el nombre del campo que se muestra en la lista de productos, en este caso el nombre del producto y se usa tambien para el buscador de ambito global.

    // modelLabel es el nombre que se muestra en la vista de crear y editar producto, en este caso "Items"
    // protected static ?string $modelLabel = 'items';

    // navigationLabel es el nombre que se muestra en el menu lateral, en este caso "Mis Items"
    // protected static ?string $navigationLabel = 'Mis Items';

    // navigationSort es el orden en el que se muestra en el menu lateral
    // protected static ?int $navigationSort = 1;

    // navigationGroup es el grupo al que pertenece en el menu lateral, en este caso "Gestión de Inventario"
    protected static string | UnitEnum | null $navigationGroup = 'Gestión de Inventario';

    // slug es la ruta que se muestra en la url, en este caso "products-page"
    // protected static ?string $slug = 'products-page';

    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProductInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
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
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'view' => ViewProduct::route('/{record}'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    // Mostrar solo los productos activos en la lista de productos
    // public static function getEloquentQuery(): Builder
    // {
    //     return parent::getEloquentQuery()->where('is_active', true);
    // }
}
