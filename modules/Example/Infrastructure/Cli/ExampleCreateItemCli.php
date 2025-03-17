<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Cli;

use Illuminate\Console\Command;
use Modules\Common\Application\Bus\Command\CommandBusInterface;
use Modules\Example\Application\Commands\CreateExampleItem;

/**
 * Консольная команда для создания новой записи модели Example.
 */
class ExampleCreateItemCli extends Command
{
    protected $signature = 'app:example-create-item {name} {description}';

    public function handle(CommandBusInterface $commandBus): int
    {
        $command = CreateExampleItem::from($this->arguments());
        $commandBus->dispatch($command);

        return self::SUCCESS;
    }
}
