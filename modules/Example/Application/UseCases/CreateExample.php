<?php

declare(strict_types=1);

namespace Modules\Example\Application\UseCases;

use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;

/**
 * UseCase для создания новой записи модели Example.
 */
final readonly class CreateExample
{
    public function __construct(
        private ExampleRepositoryInterface $repository
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public function handle(array $data): void
    {
        $this->repository->create($data);
    }
}
