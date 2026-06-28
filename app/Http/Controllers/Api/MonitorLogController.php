<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MonitorLog;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MonitorLogController extends Controller
{
    /**
     * Menerima webhook dari Cloudflare Worker dan simpan ke DB.
     * Header wajib: X-Monitor-Secret: <nilai di .env MONITOR_SECRET>
     */
    public function store(Request $request): JsonResponse
    {
        // Validasi secret token
        $secret = config('services.monitor.secret');
        if ($secret && $request->header('X-Monitor-Secret') !== $secret) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'status'            => 'required|in:up,down',
            'monitor_name'      => 'nullable|string|max:255',
            'monitor_url'       => 'nullable|url|max:500',
            'response_time'     => 'nullable|integer',
            'alert_details'     => 'nullable|string',
            'notified_telegram' => 'nullable|boolean',
            'source'            => 'nullable|string|max:100',
        ]);

        $log = MonitorLog::create([
            'status'            => $validated['status'],
            'monitor_name'      => $validated['monitor_name'] ?? 'Website Utama',
            'monitor_url'       => $validated['monitor_url'] ?? 'https://www.fajarjaya.my.id',
            'response_time'     => $validated['response_time'] ?? null,
            'alert_details'     => $validated['alert_details'] ?? null,
            'notified_telegram' => $validated['notified_telegram'] ?? false,
            'source'            => $validated['source'] ?? 'cloudflare-worker',
        ]);

        // Auto-pruning: Hapus log lama yang lebih dari 7 hari agar DB tidak penuh
        MonitorLog::where('created_at', '<', now()->subDays(7))->delete();

        return response()->json([
            'success' => true,
            'id'      => $log->id,
            'status'  => $log->status,
        ], 201);
    }

    /**
     * Endpoint publik untuk mendapatkan status terkini (bisa dipakai widget frontend).
     */
    public function status(): JsonResponse
    {
        $latest = MonitorLog::latest()->first();

        return response()->json([
            'status'           => $latest?->status ?? 'up',
            'last_check'       => $latest?->created_at?->toIso8601String(),
            'uptime_7d'        => MonitorLog::uptimePercentage(7) . '%',
            'uptime_30d'       => MonitorLog::uptimePercentage(30) . '%',
            'avg_response_7d'  => MonitorLog::avgResponseTime(7) . ' ms',
        ]);
    }
}
