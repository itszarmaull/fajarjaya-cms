<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Produk')
                    ->placeholder('Contoh: Kusen Aluminium 3 Inch')
                    ->required(),
                TextInput::make('slug')
                    ->hidden(),
                FileUpload::make('image')
                    ->label('Gambar Produk')
                    ->image()
                    ->maxSize(2048)
                    ->directory('products'),
                TextInput::make('category')
                    ->label('Kategori / Tag (Badge)')
                    ->placeholder('Contoh: FASAD KACA'),
                Textarea::make('description')
                    ->label('Deskripsi Lengkap')
                    ->columnSpanFull(),
                \Filament\Forms\Components\KeyValue::make('specifications')
                    ->label('Spesifikasi Teknis')
                    ->keyLabel('Nama Spesifikasi (Misal: Kaca)')
                    ->valueLabel('Nilai (Misal: Panasap / Stopsol)')
                    ->columnSpanFull(),
                \Filament\Forms\Components\Repeater::make('features')
                    ->label('Keunggulan Produk Ini')
                    ->schema([
                        Select::make('icon')
                            ->label('Icon Keunggulan')
                            ->options([
                                'ph-fill ph-shield-check' => '🛡️ Keamanan / Garansi (Shield)',
                                'ph-fill ph-ruler-precision' => '📐 Presisi / Akurat (Ruler)',
                                'ph-fill ph-paint-brush-broad' => '🎨 Warna / Desain (Paint Brush)',
                                'ph-fill ph-drop' => '💧 Anti Air / Bocor (Drop)',
                                'ph-fill ph-sun' => '☀️ Tahan Panas (Sun)',
                                'ph-fill ph-wind' => '💨 Tahan Angin (Wind)',
                                'ph-fill ph-frame-corners' => '🖼️ Kusen / Sudut (Frame)',
                                'ph-fill ph-door-sliding' => '🚪 Pintu Geser (Sliding Door)',
                                'ph-fill ph-windows-logo' => '🪟 Jendela (Window)',
                                'ph-fill ph-lock-key' => '🔒 Sistem Kunci (Lock)',
                                'ph-fill ph-check-circle' => '✅ Keunggulan Umum (Check)',
                                'ph-fill ph-star' => '⭐ Kualitas Premium (Star)',
                                'ph-fill ph-leaf' => '🌿 Ramah Lingkungan (Leaf)',
                                'ph-fill ph-lightning' => '⚡ Cepat / Instan (Lightning)',
                                'ph-fill ph-money' => '💰 Hemat Biaya (Money)',
                                'ph-fill ph-wrench' => '🔧 Mudah Dirawat (Wrench)',
                            ])
                            ->searchable()
                            ->required(),
                        TextInput::make('title')
                            ->label('Judul Keunggulan')
                            ->placeholder('Contoh: Tahan Cuaca')
                            ->required(),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
