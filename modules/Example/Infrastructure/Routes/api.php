<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Example\Infrastructure\Http\Controllers\Api\ApiExampleController;

/**
 * API-маршруты для модуля Example.
 */
Route::get('/example', [ApiExampleController::class, 'index'])->name('example.index');
Route::post('/example', [ApiExampleController::class, 'store'])->name('example.store');
