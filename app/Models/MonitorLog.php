<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class MonitorLog extends Model
{
    protected $fillable = [
        'status',
        'monitor_name',
        'monitor_url',
        'response_time',
        'alert_details',
        'notified_telegram',
        'source',
    ];

    protected $casts = [
        'notified_telegram' => 'boolean',
        'response_time'     => 'integer',
    ];

    // Scopes
    public function scopeDown(Builder $query): Builder
    {
        return $query->where('status', 'down');
    }

    public function scopeUp(Builder $query): Builder
    {
        return $query->where('status', 'up');
    }

    // Helpers
    public static function currentStatus(): string
    {
        $latest = static::latest()->first();
        return $latest?->status ?? 'up';
    }

    public static function uptimePercentage(int $days = 7): float
    {
        $total = static::where('created_at', '>=', now()->subDays($days))->count();
        if ($total === 0) return 100.0;

        $downCount = static::down()
            ->where('created_at', '>=', now()->subDays($days))
            ->count();

        return round((($total - $downCount) / $total) * 100, 2);
    }

    public static function lastDowntime(): ?self
    {
        return static::down()->latest()->first();
    }

    public static function avgResponseTime(int $days = 7): ?int
    {
        return (int) static::whereNotNull('response_time')
            ->where('created_at', '>=', now()->subDays($days))
            ->avg('response_time');
    }
}
