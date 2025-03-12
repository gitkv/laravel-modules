<?php

declare(strict_types=1);

namespace Modules\Example\Application\Commands\Handlers;

use Modules\Common\Application\Bus\Command\CommandHandlerInterface;
use Modules\Example\Application\Commands\CreateExampleItem;
use Modules\Example\Application\DTO\ExampleData;
use Modules\Example\Application\Services\ExampleService;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;

class CreateExampleItemHandler implements CommandHandlerInterface {

    public function __construct(
        private ExampleService $service,
        private ExampleRepositoryInterface $repository,
    ) {}

    public function handle(CreateExampleItem $command): string
    {
        $slug = $this->service->generateSlug($command->name);

        return $this->repository->create(ExampleData::from([
            'name' => $command->name,
            'description' => $command->description,
            'slug' => $slug,
        ]));
    }
}
