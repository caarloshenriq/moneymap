<?php

use App\Http\Controllers\BalanceController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::post('/balance', [BalanceController::class, 'store'])->name('balance.store');

    //views
    Route::get('/balances', [BalanceController::class, 'index'])->name('balance.index');
    Route::get('/balance/new', [BalanceController::class, 'create'])->name('balance.create');
    Route::get('/dashboard', [BalanceController::class, 'summary'])->name('dashboard');
});
