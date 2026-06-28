<?php

namespace App\Filament\Resources\SeoMetas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class SeoMetaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('url')
                    ->label('URL Halaman')
                    ->placeholder('Contoh: / atau /produk atau /tentang')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('title')
                    ->label('Judul SEO (Title Tag)')
                    ->placeholder('Contoh: Jasa Kusen Aluminium Tangerang | Fajar Jaya')
                    ->required()
                    ->maxLength(60),
                Textarea::make('description')
                    ->label('Deskripsi Meta (Meta Description)')
                    ->placeholder('Singkat, padat, dan mengandung kata kunci...')
                    ->maxLength(160)
                    ->columnSpanFull(),
                TextInput::make('keywords')
                    ->label('Kata Kunci (Meta Keywords)')
                    ->placeholder('Contoh: kusen aluminium, kaca tempered')
                    ->columnSpanFull(),
                FileUpload::make('og_image')
                    ->label('Gambar Open Graph (Untuk Share FB/WA)')
                    ->image()
                    ->directory('seo')
                    ->columnSpanFull(),
            ]);
    }
}
