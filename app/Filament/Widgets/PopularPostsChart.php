<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Post;

class PopularPostsChart extends ChartWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 1;
    protected ?string $maxHeight = '280px';
    protected ?string $heading = '🔥 Artikel Terpopuler (by Views)';

    protected function getData(): array
    {
        $posts = Post::where('status', 'published')
            ->orderByDesc('views_count')
            ->take(5)
            ->get(['title', 'views_count']);

        return [
            'datasets' => [
                [
                    'label'           => 'Total Views',
                    'data'            => $posts->pluck('views_count')->toArray(),
                    'backgroundColor' => [
                        'rgba(26, 86, 219, 0.85)',
                        'rgba(26, 86, 219, 0.65)',
                        'rgba(26, 86, 219, 0.50)',
                        'rgba(26, 86, 219, 0.35)',
                        'rgba(26, 86, 219, 0.20)',
                    ],
                    'borderColor'     => '#1A56DB',
                    'borderWidth'     => 1,
                    'borderRadius'    => 6,
                ],
            ],
            'labels' => $posts->map(fn ($p) => \Illuminate\Support\Str::limit($p->title, 25))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
