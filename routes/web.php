<?php

use App\Http\Controllers\TradeBotController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/', [TradeBotController::class, 'index']);
    // Route::get('/', [TradeBotController::class, 'getalltrade']);
    // Route::any('/order', [TradeBotController::class, 'placeOrder']);
});
