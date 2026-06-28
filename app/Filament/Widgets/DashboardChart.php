<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class DashboardChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    protected ?string $maxHeight = '300px';
    protected ?string $heading = 'Kunjungan Website Bulanan';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Kunjungan',
                    'data' => [120, 150, 110, 240, 310, 420, 380, 500, 620, 580, 700, 850],
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)',
                    'fill' => 'start',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
