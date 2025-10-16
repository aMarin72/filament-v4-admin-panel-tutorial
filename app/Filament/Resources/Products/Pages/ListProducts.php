<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Models\Product;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    // Muestra los productos activos, inactivos y todos en la vista de lista de productos
    // is_active es un campo booleano en el modelo Product, ver migracion 2025_10_14_083548_create_products_table.php
    public function getTabs(): array
{
    return [
        'all' => Tab::make(),
        'active' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', true))
            ->badge(Product::query()->where('is_active', true)->count()),
        'inactive' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', false))
            ->badge(Product::query()->where('is_active', false)->count()),
    ];
}
}
