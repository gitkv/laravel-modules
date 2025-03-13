<?php

declare(strict_types=1);

namespace Modules\Example\Application\Commands\Handlers;

use Modules\Common\Application\Bus\Command\CommandHandlerInterface;
use Modules\Example\Application\Commands\CreateExampleItem;
use Modules\Example\Application\DTO\ExampleData;
use Modules\Example\Application\Events\ExampleCreated;
use Modules\Example\Application\Services\ExampleService;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;

/** @implements CommandHandlerInterface<CreateExampleItem, string> */
class CreateExampleItemHandler implements CommandHandlerInterface
{
    public function __construct(
        private ExampleService $service,
        private ExampleRepositoryInterface $repository,
    ) {}

    public function handle(CreateExampleItem $command): string
    {
        $slug = $this->service->generateSlug($command->name);

        $item = $this->repository->create(ExampleData::from([
            'name' => $command->name,
            'description' => $command->description,
            'slug' => $slug,
        ]));

        ExampleCreated::dispatch($item->id, $item->name);

        // todo: временное решение пока не реализованы uuid как foreign key
        return (string) $item->id;
    }
}
