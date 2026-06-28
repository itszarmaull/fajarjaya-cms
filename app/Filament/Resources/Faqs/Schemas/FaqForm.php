<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('question')
                    ->label('Pertanyaan')
                    ->placeholder('Contoh: Apakah Fajar Jaya memberikan garansi?')
                    ->required(),
                Textarea::make('answer')
                    ->label('Jawaban')
                    ->placeholder('Contoh: Ya, kami memberikan garansi kebocoran selama 3 bulan...')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('sort_order')
                    ->label('Urutan Tampilan')
                    ->numeric()
                    ->default(0)
                    ->placeholder('Semakin kecil nilainya, semakin atas posisinya'),
            ]);
    }
}
