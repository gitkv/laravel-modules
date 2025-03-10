<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Commands;

use Illuminate\Console\Command;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;

/**
 * Консольная команда для создания новой записи модели Example.
 */
class ExampleCommand extends Command
{
    protected $signature = 'app:example {name} {description}';

    public function handle(ExampleRepositoryInterface $repository): int
    {
        $repository->create([
            'name' => $this->argument('name'),
            'description' => $this->argument('description'),
        ]);

        return self::SUCCESS;
    }
}
