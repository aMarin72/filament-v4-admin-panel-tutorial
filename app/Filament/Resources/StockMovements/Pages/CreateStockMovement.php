<?php

namespace App\Filament\Resources\StockMovements\Pages;

use App\Filament\Resources\StockMovements\StockMovementResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateStockMovement extends CreateRecord
{
    protected static string $resource = StockMovementResource::class;

    // Hemos anulado el campo user_id, para que no se muestre en el formulario de crear movimiento de stock, y lo hemos seteado en el metodo mutateFormDataBeforeCreate

    // Customizing data before saving (Personalizar datos antes de guardar):
    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $data['user_id'] = auth()->id();
    //     return $data;
    // }

    // Customizing the creation process (Personalizar el proceso de creación):
    protected function handleRecordCreation(array $data): Model
    {
        $data['user_id'] = auth()->id();
        return static::getModel()::create($data);
    }

    // Redirige a la vista index de la lista de movimientos de stock.
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Cambia el titulo de la notificacion de creado
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Movimiento de Stock creado satisfactoriamente.';
    }
}
