<?php

declare(strict_types=1);

namespace Modules\Common\Infrastructure\Providers;

use Illuminate\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Modules\Common\Application\Bus\Command\CommandBusInterface;
use Modules\Common\Application\Bus\Command\LaravelCommandBus;
use Modules\Common\Application\Bus\Command\Middleware\CommandLoggingMiddleware;
use Modules\Common\Application\Bus\Command\Middleware\TransactionMiddleware;
use Modules\Common\Application\Bus\Query\LaravelQueryBus;
use Modules\Common\Application\Bus\Query\Middleware\CachingMiddleware;
use Modules\Common\Application\Bus\Query\Middleware\QueryLoggingMiddleware;
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
        $this->registerCommandBus();
        $this->registerQueryBus();
    }

    private function registerCommandBus(): void
    {
        $this->app->singleton('command.bus.dispatcher', function ($app) {
            $dispatcher = new Dispatcher($app);
            $dispatcher->pipeThrough([
                CommandLoggingMiddleware::class,
                TransactionMiddleware::class,
            ]);

            return $dispatcher;
        });
    }

    private function registerQueryBus(): void
    {
        $this->app->singleton('query.bus.dispatcher', function ($app) {
            $dispatcher = new Dispatcher($app);
            $dispatcher->pipeThrough([
                QueryLoggingMiddleware::class,
                CachingMiddleware::class,
            ]);

            return $dispatcher;
        });
    }
}
