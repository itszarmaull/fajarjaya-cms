<?php

namespace App\Filament\Resources\CalculatorOptions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CalculatorOptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'kusen' => 'warning',
                        'warna' => 'success',
                        'kaca' => 'info',
                        'unit' => 'primary',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'kusen' => 'Kusen Aluminium',
                        'warna' => 'Finishing Warna',
                        'kaca' => 'Pemasangan Kaca',
                        'unit' => 'Pintu & Jendela (Unit)',
                        default => $state,
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama Pilihan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Harga')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('type')
                    ->label('Kategori')
                    ->options([
                        'kusen' => 'Kusen Aluminium',
                        'warna' => 'Finishing Warna',
                        'kaca' => 'Pemasangan Kaca',
                        'unit' => 'Pintu & Jendela (Unit)',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
