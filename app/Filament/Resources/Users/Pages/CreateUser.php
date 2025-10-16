<?php

namespace App\Filament\Resources\Users\Pages;

use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Users\UserResource;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    // Evita el boton de "Crear otro"
    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Agrega un boton a la cabecera cunado se crea un usuario.
    /**
     * Las “Acciones” son botones que se muestran en las páginas y que permiten al usuario ejecutar un método Livewire en la página o visitar una URL.En las páginas de recursos, las acciones suelen estar en dos lugares: en la parte superior derecha de la página y debajo del formulario.
     */
    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Action::make('Disable User')
    //             ->action('disableUser'),
    //     ];
    // }
}
