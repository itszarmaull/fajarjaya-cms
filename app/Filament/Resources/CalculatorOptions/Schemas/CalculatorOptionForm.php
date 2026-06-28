<?php

namespace App\Filament\Resources\CalculatorOptions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CalculatorOptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->label('Kategori')
                    ->options([
                        'kusen' => 'Kusen Aluminium',
                        'warna' => 'Finishing Warna Kusen',
                        'kaca' => 'Pemasangan Kaca',
                        'unit' => 'Pintu & Jendela (Unit)',
                    ])
                    ->required(),
                TextInput::make('name')
                    ->label('Nama Pilihan')
                    ->required(),
                TextInput::make('price')
                    ->label('Harga')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->required(),
                TextInput::make('sort_order')
                    ->label('Urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
