<?php

use App\Http\Controllers\Api\MonitorLogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Monitoring endpoints — dilindungi X-Monitor-Secret header
Route::prefix('monitor')->group(function () {
    Route::post('/log', [MonitorLogController::class, 'store']);
    Route::get('/status', [MonitorLogController::class, 'status']);
});
