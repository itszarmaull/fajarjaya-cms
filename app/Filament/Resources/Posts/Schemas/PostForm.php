<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Artikel')
                    ->placeholder('Contoh: Tips Memilih Kusen Aluminium Berkualitas')
                    ->required(),
                TextInput::make('slug')
                    ->hidden(),
                FileUpload::make('featured_image')
                    ->label('Gambar Utama (Cover)')
                    ->image()
                    ->maxSize(2048)
                    ->directory('posts'),
                TextInput::make('category')
                    ->label('Kategori')
                    ->placeholder('Contoh: Edukasi, Tips, Proyek'),
                Textarea::make('excerpt')
                    ->label('Kutipan Singkat (Excerpt)')
                    ->placeholder('Rangkuman singkat artikel untuk daftar halaman blog...')
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->label('Konten Artikel Lengkap')
                    ->required()
                    ->columnSpanFull(),
                Select::make('status')
                    ->label('Status Publikasi')
                    ->options([
                        'draft' => 'Draft / Simpan Saja',
                        'published' => 'Published / Terbitkan',
                    ])
                    ->default('draft')
                    ->required(),
            ]);
    }
}
