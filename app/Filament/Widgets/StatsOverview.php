<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Produk', Product::count())
                ->description('Jumlah produk di katalog')
                ->descriptionIcon('heroicon-m-cube')
                ->color('success'),
            Stat::make('Total Proyek', Project::count())
                ->description('Portofolio yang telah selesai')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('info'),
            Stat::make('Pesan Masuk', \App\Models\ContactMessage::count())
                ->description(\App\Models\ContactMessage::where('status', 'unread')->count() . ' pesan belum dibaca')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('warning'),
        ];
    }
}
