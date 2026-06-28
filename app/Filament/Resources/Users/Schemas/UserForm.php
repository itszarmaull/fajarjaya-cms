<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->placeholder('Masukkan nama lengkap user')
                    ->required(),
                TextInput::make('email')
                    ->label('Alamat Email')
                    ->placeholder('Contoh: admin@fajarjaya.com')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),
                Select::make('role')
                    ->label('Peran / Hak Akses (Role)')
                    ->options([
                        'superadmin' => 'Superadmin (Akses Penuh)',
                        'admin' => 'Admin Biasa (Akses Terbatas)',
                    ])
                    ->default('admin')
                    ->required(),
                TextInput::make('password')
                    ->label('Kata Sandi (Password)')
                    ->password()
                    ->placeholder(fn ($record) => $record ? 'Kosongkan jika tidak ingin mengubah password' : 'Masukkan password baru')
                    ->dehydrated(fn ($state) => filled($state))
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->required(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord),
            ]);
    }
}
