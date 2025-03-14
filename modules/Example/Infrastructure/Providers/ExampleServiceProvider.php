<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Common\Application\Bus\Command\CommandBusInterface;
use Modules\Common\Application\Bus\Query\QueryBusInterface;
use Modules\Example\Application\Commands\CreateExampleItem;
use Modules\Example\Application\Commands\Handlers\CreateExampleItemHandler;
use Modules\Example\Application\Query\GetAllExampleWithPaginate;
use Modules\Example\Application\Query\GetExampleById;
use Modules\Example\Application\Query\Handlers\GetAllExampleWithPaginateHandler;
use Modules\Example\Application\Query\Handlers\GetExampleByIdHandler;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;
use Modules\Example\Infrastructure\Repositories\EloquentExampleRepository;

/**
 * Сервис-провайдер для модуля Example.
 * Регистрирует миграции и представления.
 */
class ExampleServiceProvider extends ServiceProvider
{
    /** @var array<class-string, class-string> */
    public $singletons = [
        ExampleRepositoryInterface::class => EloquentExampleRepository::class,
    ];

    public function boot(): void
    {
        $this->loadViewsFrom(dirname(__DIR__).'/Resources/Views', 'example');

        $this->registerCommandHandlers();
        $this->registerQueryHandlers();
    }

    protected function registerCommandHandlers(): void
    {
        $commandBus = app(CommandBusInterface::class);
        $commandBus->register([
            CreateExampleItem::class => CreateExampleItemHandler::class,
        ]);
    }

    protected function registerQueryHandlers(): void
    {
        $queryBus = app(QueryBusInterface::class);
        $queryBus->register([
            GetExampleById::class => GetExampleByIdHandler::class,
            GetAllExampleWithPaginate::class => GetAllExampleWithPaginateHandler::class,
        ]);
    }
}
