<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Pengirim')
                    ->disabled(),
                TextInput::make('contact_info')
                    ->label('Info Kontak (Email/WA)')
                    ->disabled(),
                TextInput::make('subject')
                    ->label('Subjek Pesan')
                    ->columnSpanFull()
                    ->disabled(),
                Textarea::make('message')
                    ->label('Isi Pesan')
                    ->columnSpanFull()
                    ->disabled(),
                Select::make('status')
                    ->label('Status Pesan')
                    ->options([
                        'unread' => 'Belum Dibaca',
                        'read' => 'Sudah Dibaca',
                        'replied' => 'Sudah Dibalas',
                    ])
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
