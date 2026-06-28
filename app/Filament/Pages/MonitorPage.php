<?php

namespace App\Filament\Pages;

use App\Models\MonitorLog;
use Filament\Pages\Page;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class MonitorPage extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-signal';
    protected static ?string $navigationLabel = 'Monitor Website';
    protected static ?string $title           = '🛡️ Monitor Website';
    protected static ?int    $navigationSort  = 99;

    protected string $view = 'filament.pages.monitor-page';

    /**
     * Hanya daftarkan navigasi jika user adalah superadmin
     */
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->check() && auth()->user()->role === 'superadmin';
    }

    public function mount(): void
    {
        // Blokir akses jika bukan superadmin
        abort_unless(auth()->check() && auth()->user()->role === 'superadmin', 403);
    }

    /**
     * Tampilkan widget status di bagian atas halaman
     */
    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Pages\MonitorStatusWidget::class,
        ];
    }

    /**
     * Definisikan tabel log monitoring dengan UI modern Filament
     */
    public function table(Table $table): Table
    {
        return $table
            ->query(MonitorLog::query()->latest())
            ->columns([
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'up' => 'success',
                        'down' => 'danger',
                        default => 'secondary',
                    })
                    ->formatStateUsing(fn (string $state): string => strtoupper($state)),

                TextColumn::make('monitor_name')
                    ->label('Nama Monitor')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('monitor_url')
                    ->label('URL')
                    ->searchable()
                    ->copyable()
                    ->color('primary')
                    ->limit(40),

                TextColumn::make('response_time')
                    ->label('Respon')
                    ->suffix(' ms')
                    ->sortable()
                    ->alignEnd()
                    ->color(fn (?int $state): string => 
                        $state && $state < 500 ? 'success' : ($state && $state < 1000 ? 'warning' : 'danger')
                    )
                    ->placeholder('-'),

                TextColumn::make('alert_details')
                    ->label('Detail Error / Pesan')
                    ->limit(50)
                    ->wrap()
                    ->placeholder('-'),

                IconColumn::make('notified_telegram')
                    ->label('Telegram')
                    ->boolean()
                    ->trueIcon('heroicon-o-paper-airplane')
                    ->falseIcon('heroicon-o-minus-circle')
                    ->trueColor('info')
                    ->falseColor('gray')
                    ->alignCenter(),

                TextColumn::make('created_at')
                    ->label('Waktu Kejadian')
                    ->dateTime('d M Y, H:i:s')
                    ->description(fn (MonitorLog $record): string => $record->created_at->diffForHumans())
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50]);
    }
}
