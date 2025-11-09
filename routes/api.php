<?php

use App\Http\Controllers\Api\FeedingController;
use App\Http\Controllers\Api\SleepController;
use App\Http\Controllers\Api\DiaperChangeController;
use App\Http\Controllers\Api\GrowthMetricController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Baby Logger API Routes
Route::apiResource('feedings', FeedingController::class);
Route::apiResource('sleeps', SleepController::class);
Route::apiResource('diaper-changes', DiaperChangeController::class);
Route::apiResource('growth-metrics', GrowthMetricController::class);

// Additional endpoints for analytics
Route::get('/feedings/stats/today', [FeedingController::class, 'todayStats']);
Route::get('/sleeps/stats/today', [SleepController::class, 'todayStats']);
Route::get('/diaper-changes/stats/today', [DiaperChangeController::class, 'todayStats']);

