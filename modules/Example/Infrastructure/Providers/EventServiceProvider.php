<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Example\Application\Events\ExampleCreated;
use Modules\Example\Application\Listeners\LogExampleCreated;
use Override;

/**
 * Сервис-провайдер для модуля Example2.
 */
class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ExampleCreated::class => [
            LogExampleCreated::class,
        ],
    ];

    #[Override]
    public function boot(): void {}
}
