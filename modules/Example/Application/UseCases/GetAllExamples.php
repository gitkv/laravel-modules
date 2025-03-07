<?php

declare(strict_types=1);

namespace Modules\Example\Application\UseCases;

use Modules\Example\Domain\Models\Example;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;

final readonly class GetAllExamples
{
    public function __construct(
        private ExampleRepositoryInterface $repository
    ) {}

    /**
     * @return array<Example>
     */
    public function handle(): array
    {
        return $this->repository->getAll();
    }
}
