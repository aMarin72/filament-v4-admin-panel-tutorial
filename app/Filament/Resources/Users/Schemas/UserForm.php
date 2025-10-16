<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->label('Contraseña (dejar vacío para mantener la actual)') // Opcional: para guiar al usuario
                    ->dehydrated(fn($state) => filled($state)) // Solo deshidrata si el campo está lleno
                    ->dehydrateStateUsing(fn($state) => Hash::make($state)) // Hashea la contraseña si se rellena
                    ->required(fn(string $context): bool => $context === 'create')
                    ->maxLength(255)
                    ->minLength(8)
                    ->revealable(), // Opcional: para ver la contraseña
            ]);
    }
}
