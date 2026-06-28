<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\ContactMessage;
use Illuminate\Support\Carbon;

class DashboardChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    protected ?string $maxHeight = '300px';
    protected ?string $heading = '📩 Pesan Masuk per Bulan (Real Data)';

    protected function getData(): array
    {
        // Ambil data pesan masuk 12 bulan terakhir dari database
        $data = [];
        $labels = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->translatedFormat('M Y');
            $data[] = ContactMessage::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label'           => 'Pesan Masuk',
                    'data'            => $data,
                    'borderColor'     => '#1A56DB',
                    'backgroundColor' => 'rgba(26, 86, 219, 0.15)',
                    'fill'            => 'start',
                    'tension'         => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
