<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Product;

class ProductCategoryChart extends ChartWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 1;
    protected ?string $maxHeight = '280px';
    protected ?string $heading = '📦 Distribusi Produk per Kategori';

    protected function getData(): array
    {
        $categories = Product::query()
            ->selectRaw('category, COUNT(*) as total')
            ->whereNotNull('category')
            ->groupBy('category')
            ->orderByDesc('total')
            ->get();

        $colors = [
            'rgba(26, 86, 219, 0.85)',
            'rgba(59, 130, 246, 0.75)',
            'rgba(96, 165, 250, 0.70)',
            'rgba(147, 197, 253, 0.65)',
            'rgba(191, 219, 254, 0.60)',
            'rgba(14, 165, 233, 0.75)',
        ];

        return [
            'datasets' => [
                [
                    'label'           => 'Jumlah Produk',
                    'data'            => $categories->pluck('total')->toArray(),
                    'backgroundColor' => array_slice($colors, 0, $categories->count()),
                    'borderColor'     => '#0F172A',
                    'borderWidth'     => 2,
                ],
            ],
            'labels' => $categories->pluck('category')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
