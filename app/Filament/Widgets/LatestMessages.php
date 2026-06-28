<?php

namespace App\Filament\Widgets;

use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\ContactMessage;
use Filament\Tables\Columns\TextColumn;

class LatestMessages extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(ContactMessage::query()->latest()->limit(5))
            ->heading('Pesan Masuk Terbaru')
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Pengirim')
                    ->weight('bold'),
                TextColumn::make('contact_info')
                    ->label('Kontak (Email/WA)'),
                TextColumn::make('subject')
                    ->label('Subjek'),
                TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(50),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'unread' => 'warning',
                        'read' => 'info',
                        'replied' => 'success',
                    }),
                TextColumn::make('created_at')
                    ->label('Tanggal Masuk')
                    ->dateTime()
                    ->sortable(),
            ])
            ->paginated(false);
    }
}
