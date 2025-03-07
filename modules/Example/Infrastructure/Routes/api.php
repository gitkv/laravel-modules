<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Example\Infrastructure\Controllers\ExampleController;

Route::get('/example', [ExampleController::class, 'index']);
