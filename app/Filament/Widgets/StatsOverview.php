<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Project;
use App\Models\Post;
use App\Models\ContactMessage;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $unreadMessages = ContactMessage::where('status', 'unread')->count();
        $totalMessages  = ContactMessage::count();
        $totalProducts  = Product::count();
        $totalProjects  = Project::count();
        $publishedPosts = Post::where('status', 'published')->count();
        $draftPosts     = Post::where('status', 'draft')->count();
        $totalViews     = Post::sum('views_count');

        return [
            Stat::make('Total Produk', $totalProducts)
                ->description('Produk aktif di katalog website')
                ->descriptionIcon('heroicon-m-cube')
                ->color('success')
                ->chart([3, 5, 4, 6, $totalProducts]),

            Stat::make('Total Proyek', $totalProjects)
                ->description('Portofolio yang telah diselesaikan')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('info')
                ->chart([1, 2, 3, 4, $totalProjects]),

            Stat::make('Pesan Masuk', $totalMessages)
                ->description($unreadMessages > 0 ? "{$unreadMessages} pesan belum dibaca 🔴" : 'Semua pesan sudah dibaca ✅')
                ->descriptionIcon('heroicon-m-envelope')
                ->color($unreadMessages > 0 ? 'danger' : 'success'),

            Stat::make('Artikel Blog', $publishedPosts)
                ->description("{$draftPosts} draft • {$totalViews} total views")
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning')
                ->chart([1, 2, 3, $publishedPosts]),
        ];
    }
}
