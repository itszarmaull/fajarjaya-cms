<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Nama Proyek')
                    ->placeholder('Contoh: Pemasangan Kusen Gedung A')
                    ->required(),
                TextInput::make('slug')
                    ->hidden(),
                TextInput::make('category')
                    ->label('Kategori Proyek')
                    ->placeholder('Contoh: Fasad, Pintu, Jendela'),
                FileUpload::make('image')
                    ->label('Gambar Proyek')
                    ->image()
                    ->maxSize(2048)
                    ->directory('projects'),
                Textarea::make('description')
                    ->label('Deskripsi Lengkap')
                    ->columnSpanFull(),
            ]);
    }
}
