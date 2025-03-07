<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;

class ExampleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(dirname(__DIR__).'/Database/Migrations');
        $this->loadViewsFrom(dirname(__DIR__).'/Resources/Views', 'example');
    }
}
