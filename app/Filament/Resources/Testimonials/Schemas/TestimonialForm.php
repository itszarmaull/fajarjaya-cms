<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Klien')
                    ->placeholder('Contoh: Bpk. Heru Wijaya')
                    ->required(),
                TextInput::make('company')
                    ->label('Perusahaan / Jabatan / Lokasi')
                    ->placeholder('Contoh: Owner Cafe Serpong / Rumah Tinggal Bintaro'),
                FileUpload::make('avatar')
                    ->label('Foto Klien (Avatar)')
                    ->image()
                    ->maxSize(1024)
                    ->directory('testimonials'),
                Select::make('rating')
                    ->label('Rating (Bintang)')
                    ->options([
                        '1' => '⭐ (1 Bintang)',
                        '2' => '⭐⭐ (2 Bintang)',
                        '3' => '⭐⭐⭐ (3 Bintang)',
                        '4' => '⭐⭐⭐⭐ (4 Bintang)',
                        '5' => '⭐⭐⭐⭐⭐ (5 Bintang)',
                    ])
                    ->default('5')
                    ->required(),
                Textarea::make('content')
                    ->label('Isi Ulasan')
                    ->placeholder('Tulis ulasan/testimoni pelanggan di sini...')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
