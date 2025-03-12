<?php

declare(strict_types=1);

namespace Modules\Example\Application\UseCases;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;

/**
 * UseCase для получения всех записей модели Example.
 */
final readonly class GetAllExamplesWithPaginate
{
    public function __construct(
        private ExampleRepositoryInterface $repository
    ) {}

    public function execute(): LengthAwarePaginator
    {
        return $this->repository->paginate();
    }
}
