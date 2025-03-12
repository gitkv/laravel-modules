<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Example\Infrastructure\Http\Controllers\ExampleController;

/**
 * Веб-маршруты для модуля Example.
 */
Route::prefix('examples')->name('example.')->group(function () {
    Route::get('/', [ExampleController::class, 'index'])->name('index');
    Route::get('/create', [ExampleController::class, 'create'])->name('create');
    Route::post('/', [ExampleController::class, 'store'])->name('store');
});
