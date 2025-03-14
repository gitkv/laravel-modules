<?php

declare(strict_types=1);

namespace Modules\Common\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Common\Application\Bus\Command\CommandBusInterface;
use Modules\Common\Application\Bus\Command\CommandDispatcher;
use Modules\Common\Application\Bus\Command\LaravelCommandBus;
use Modules\Common\Application\Bus\Command\Middleware\CommandLoggingMiddleware;
use Modules\Common\Application\Bus\Command\Middleware\TransactionMiddleware;
use Modules\Common\Application\Bus\Event\ExtendedEventDispatcher;
use Modules\Common\Application\Bus\Event\Middleware\EventLoggingMiddleware;
use Modules\Common\Application\Bus\Query\LaravelQueryBus;
use Modules\Common\Application\Bus\Query\Middleware\CachingMiddleware;
use Modules\Common\Application\Bus\Query\Middleware\QueryLoggingMiddleware;
use Modules\Common\Application\Bus\Query\QueryBusInterface;
use Modules\Common\Application\Bus\Query\QueryDispatcher;
use Override;

class BusServiceProvider extends ServiceProvider
{
    /** @var array<class-string, class-string> */
    public $singletons = [
        CommandBusInterface::class => LaravelCommandBus::class,
        QueryBusInterface::class => LaravelQueryBus::class,
    ];

    /** @var class-string[] */
    private array $eventMiddlewares = [
        EventLoggingMiddleware::class,
    ];

    /** @var class-string[] */
    private array $commandMiddlewares = [
        CommandLoggingMiddleware::class,
        TransactionMiddleware::class,
    ];

    /** @var class-string[] */
    private array $queryMiddlewares = [
        QueryLoggingMiddleware::class,
        CachingMiddleware::class,
    ];

    #[Override]
    public function register(): void
    {
        $this->registerEventBus();
        $this->registerCommandBus();
        $this->registerQueryBus();
    }

    private function registerEventBus(): void
    {
        $this->app->singleton('events', function ($app) {
            $dispatcher = new ExtendedEventDispatcher($app);
            foreach ($this->eventMiddlewares as $middleware) {
                $dispatcher->addMiddleware($middleware);
            }

            return $dispatcher;
        });
    }

    private function registerCommandBus(): void
    {
        $this->app->singleton(CommandDispatcher::class, function ($app) {
            $dispatcher = new CommandDispatcher($app);
            $dispatcher->pipeThrough($this->commandMiddlewares);

            return $dispatcher;
        });
    }

    private function registerQueryBus(): void
    {
        $this->app->singleton(QueryDispatcher::class, function ($app) {
            $dispatcher = new QueryDispatcher($app);
            $dispatcher->pipeThrough($this->queryMiddlewares);

            return $dispatcher;
        });
    }
}
