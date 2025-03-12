<?php

declare(strict_types=1);


namespace Modules\Example\Application\Query\Handlers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Common\Application\Bus\Query\QueryHandlerInterface;
use Modules\Example\Application\Query\GetAllExampleWithPaginate;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;

class GetAllExampleWithPaginateHandler implements QueryHandlerInterface
{
    public function __construct(
        private ExampleRepositoryInterface $repository,
    ) {}

    public function handle(GetAllExampleWithPaginate $query): LengthAwarePaginator
    {
        return $this->repository->paginate();
    }
}
