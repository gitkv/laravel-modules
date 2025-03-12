<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Example\Infrastructure\Http\Controllers\Api\ApiExampleController;

/**
 * API-маршруты для модуля Example.
 */
Route::prefix('examples')->name('example.')->group(function () {
    Route::get('/', [ApiExampleController::class, 'index'])->name('index');
    Route::post('/', [ApiExampleController::class, 'store'])->name('store');
});
