<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Hero Beranda')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                TextInput::make('hero_title')
                                    ->label('Tagline Utama (Hero Title)')
                                    ->placeholder('Misal: Estetika Modern, Ketahanan Maksimal')
                                    ->required(),
                                Textarea::make('hero_subtitle')
                                    ->label('Sub Tagline (Hero Subtitle)')
                                    ->placeholder('Deskripsi singkat di bawah tagline')
                                    ->columnSpanFull(),
                                FileUpload::make('hero_images')
                                    ->label('Gambar Slider Hero (Multi-upload)')
                                    ->image()
                                    ->multiple()
                                    ->reorderable()
                                    ->maxSize(2048)
                                    ->directory('settings')
                                    ->columnSpanFull(),
                             ]),
                        Tabs\Tab::make('Identitas Web')
                            ->icon('heroicon-o-identification')
                            ->schema([
                                TextInput::make('company_name')
                                    ->label('Nama Perusahaan')
                                    ->placeholder('Fajar Jaya Aluminium'),
                                FileUpload::make('site_logo')
                                    ->label('Logo Website')
                                    ->image()
                                    ->maxSize(2048)
                                    ->directory('settings'),
                             ]),
                        Tabs\Tab::make('Banner Halaman')
                            ->icon('heroicon-o-queue-list')
                            ->schema([
                                FileUpload::make('banner_produk')
                                    ->label('Banner Halaman Produk')
                                    ->image()
                                    ->maxSize(2048)
                                    ->directory('settings'),
                                FileUpload::make('banner_proyek')
                                    ->label('Banner Halaman Proyek')
                                    ->image()
                                    ->maxSize(2048)
                                    ->directory('settings'),
                                FileUpload::make('banner_tentang')
                                    ->label('Banner Halaman Tentang Kami')
                                    ->image()
                                    ->maxSize(2048)
                                    ->directory('settings'),
                                FileUpload::make('banner_blog')
                                    ->label('Banner Halaman Blog')
                                    ->image()
                                    ->maxSize(2048)
                                    ->directory('settings'),
                                FileUpload::make('banner_kontak')
                                    ->label('Banner Halaman Kontak')
                                    ->image()
                                    ->maxSize(2048)
                                    ->directory('settings'),
                            ])->columns(2),
                        Tabs\Tab::make('Kontak & Sosmed')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                TextInput::make('company_whatsapp')
                                    ->label('Nomor WhatsApp')
                                    ->placeholder('Contoh: 6285813556864'),
                                TextInput::make('company_email')
                                    ->label('Alamat Email')
                                    ->email()
                                    ->placeholder('Contoh: info@fajarjaya.com'),
                                Textarea::make('company_address')
                                    ->label('Alamat Lengkap Perusahaan')
                                    ->columnSpanFull(),
                                TextInput::make('social_instagram')
                                    ->label('Link Instagram')
                                    ->url()
                                    ->placeholder('https://instagram.com/fajarjaya'),
                                TextInput::make('social_facebook')
                                    ->label('Link Facebook')
                                    ->url()
                                    ->placeholder('https://facebook.com/fajarjaya'),
                            ])->columns(2),
                    ])
                    ->columnSpanFull()
            ]);
    }
}
