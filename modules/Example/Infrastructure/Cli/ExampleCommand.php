<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Cli;

use Illuminate\Console\Command;
use Modules\Example\Application\DTO\CreateExampleData;
use Modules\Example\Application\UseCases\CreateExample;

/**
 * Консольная команда для создания новой записи модели Example.
 */
class ExampleCommand extends Command
{
    protected $signature = 'app:example {name} {description}';

    public function handle(CreateExample $handler): int
    {
        $data = CreateExampleData::from($this->arguments());
        $handler->execute($data);

        return self::SUCCESS;
    }
}
