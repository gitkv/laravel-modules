<?php

declare(strict_types=1);

namespace Modules\Common\Infrastructure\Providers;

use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Modules\Common\Application\Bus\Command\CommandBusInterface;
use Modules\Common\Application\Bus\Command\LaravelCommandBus;
use Modules\Common\Application\Bus\Command\Middleware\CommandTransactionMiddleware;
use Modules\Common\Application\Bus\Query\LaravelQueryBus;
use Modules\Common\Application\Bus\Query\QueryBusInterface;
use Override;

class BusServiceProvider extends ServiceProvider
{
    public $singletons = [
        CommandBusInterface::class => LaravelCommandBus::class,
        QueryBusInterface::class => LaravelQueryBus::class,
    ];

    #[Override]
    public function register(): void
    {
        $this->app->extend(Dispatcher::class, function (Dispatcher $dispatcher) {
            $dispatcher->pipeThrough([CommandTransactionMiddleware::class]);

            return $dispatcher;
        });
    }
}
