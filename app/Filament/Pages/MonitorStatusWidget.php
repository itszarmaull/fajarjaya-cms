<?php

namespace App\Filament\Pages;

use App\Models\MonitorLog;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MonitorStatusWidget extends BaseWidget
{
    protected static ?int $sort = 0; // Muncul PALING ATAS
    protected int | string | array $columnSpan = 'full';

    // Auto-refresh setiap 60 detik (non-static — sesuai Filament parent)
    protected ?string $pollingInterval = '60s';

    protected function getStats(): array
    {
        $latest    = MonitorLog::latest()->first();
        $status    = $latest?->status ?? 'up';
        $uptime7d  = MonitorLog::uptimePercentage(7);
        $uptime30d = MonitorLog::uptimePercentage(30);
        $avgResp   = MonitorLog::avgResponseTime(7);
        $lastDown  = MonitorLog::lastDowntime();

        // Status utama
        $isUp        = $status === 'up';
        $statusLabel = $isUp ? '🟢 ONLINE' : '🔴 OFFLINE';
        $statusDesc  = $isUp
            ? 'Website berjalan normal'
            : ($latest?->alert_details ?? 'Website tidak dapat diakses');
        $statusColor = $isUp ? 'success' : 'danger';

        // Kapan terakhir dicek
        $lastChecked = $latest?->created_at
            ? $latest->created_at->diffForHumans()
            : 'Belum ada data';

        // Last downtime info
        $lastDownDesc = $lastDown
            ? 'Terakhir down: ' . $lastDown->created_at->diffForHumans()
            : 'Belum pernah down';

        return [
            Stat::make('Status Website', $statusLabel)
                ->description($statusDesc)
                ->descriptionIcon($isUp ? 'heroicon-m-check-circle' : 'heroicon-m-x-circle')
                ->color($statusColor),

            Stat::make('Uptime 7 Hari', $uptime7d . '%')
                ->description('30 hari: ' . $uptime30d . '%')
                ->descriptionIcon('heroicon-m-clock')
                ->color($uptime7d >= 99 ? 'success' : ($uptime7d >= 95 ? 'warning' : 'danger'))
                ->chart($this->getUptimeChartData(7)),

            Stat::make('Avg. Response Time', ($avgResp > 0 ? $avgResp . ' ms' : 'N/A'))
                ->description('Rata-rata 7 hari terakhir')
                ->descriptionIcon('heroicon-m-bolt')
                ->color($avgResp > 0 && $avgResp < 500 ? 'success' : ($avgResp < 1000 ? 'warning' : 'danger')),

            Stat::make('Terakhir Dicek', $lastChecked)
                ->description($lastDownDesc)
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('gray'),
        ];
    }

    private function getUptimeChartData(int $days): array
    {
        $data = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $total = MonitorLog::whereDate('created_at', $date)->count();
            $down  = MonitorLog::down()->whereDate('created_at', $date)->count();
            $data[] = $total > 0 ? round((($total - $down) / $total) * 100, 1) : 100;
        }
        return $data;
    }
}
