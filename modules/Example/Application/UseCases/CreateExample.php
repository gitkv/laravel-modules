<?php

declare(strict_types=1);

namespace Modules\Example\Application\UseCases;

use Modules\Example\Application\DTO\CreateExampleData;
use Modules\Example\Application\Services\ExampleService;
use Modules\Example\Domain\Models\Example;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;

/**
 * UseCase для создания новой записи модели Example.
 */
final readonly class CreateExample
{
    public function __construct(
        private ExampleService $service,
        private ExampleRepositoryInterface $repository,
    ) {}

    public function execute(CreateExampleData $data): Example
    {
        $slug = $this->service->generateSlug($data->name);

        return $this->repository->create($data);
    }
}
