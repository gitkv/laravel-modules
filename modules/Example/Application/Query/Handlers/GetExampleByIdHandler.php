<?php

declare(strict_types=1);

namespace Modules\Example\Application\Query\Handlers;

use Modules\Common\Application\Bus\Query\QueryHandlerInterface;
use Modules\Example\Application\Query\GetExampleById;
use Modules\Example\Domain\Models\Example;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;

/** @implements QueryHandlerInterface<GetExampleById, Example> */
class GetExampleByIdHandler implements QueryHandlerInterface
{
    public function __construct(
        private ExampleRepositoryInterface $repository,
    ) {}

    public function handle(GetExampleById $query): ?Example
    {
        return $this->repository->getById($query->id);
    }
}
