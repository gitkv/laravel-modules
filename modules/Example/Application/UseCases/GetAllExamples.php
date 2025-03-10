<?php

declare(strict_types=1);

namespace Modules\Example\Application\UseCases;

use Modules\Example\Domain\Collections\ExampleCollection;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;

/**
 * UseCase для получения всех записей модели Example.
 */
final readonly class GetAllExamples
{
    public function __construct(
        private ExampleRepositoryInterface $repository
    ) {}

    /**
     * @return ExampleCollection
     */
    public function handle(): ExampleCollection
    {
        return $this->repository->getAll();
    }
}
