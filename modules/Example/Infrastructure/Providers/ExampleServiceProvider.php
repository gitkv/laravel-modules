<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Common\Application\Bus\Command\CommandBusInterface;
use Modules\Example\Application\Commands\CreateExampleItem;
use Modules\Example\Application\Commands\Handlers\CreateExampleItemHandler;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;
use Modules\Example\Infrastructure\Repositories\EloquentExampleRepository;

/**
 * Сервис-провайдер для модуля Example.
 * Регистрирует миграции и представления.
 */
class ExampleServiceProvider extends ServiceProvider
{

    public $singletons = [
        ExampleRepositoryInterface::class => EloquentExampleRepository::class,
    ];

    public function boot(): void
    {
        $this->loadMigrationsFrom(dirname(__DIR__).'/Database/Migrations');
        $this->loadViewsFrom(dirname(__DIR__).'/Resources/Views', 'example');

        $this->registerCommandHandlers();
    }

    protected function registerCommandHandlers(): void
    {
        $commandBus = app(CommandBusInterface::class);
        $commandBus->register([
            CreateExampleItem::class => CreateExampleItemHandler::class,
        ]);
    }

//    protected function registerQueryHandlers(): void
//    {
//        $queryBus = app(QueryBusContract::class);
//        $queryBus->register([
//            GetUserByEmailQuery::class => GetUserByEmailQueryHandler::class,
//            GetUserByIdQuery::class => GetUserByIdQueryHandler::class,
//        ]);
//    }
}
