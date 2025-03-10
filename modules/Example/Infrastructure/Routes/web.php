<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Example\Infrastructure\Controllers\ExampleController;

/**
 * Веб-маршруты для модуля Example.
 */
Route::get('/example', [ExampleController::class, 'index'])->name('example.index');
Route::get('/example/create', [ExampleController::class, 'create'])->name('example.create');
Route::post('/example', [ExampleController::class, 'store'])->name('example.store');
