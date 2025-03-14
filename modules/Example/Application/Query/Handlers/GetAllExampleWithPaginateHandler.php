<?php

declare(strict_types=1);


namespace Modules\Example\Application\Query\Handlers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Common\Application\Bus\Query\QueryHandlerInterface;
use Modules\Example\Application\Query\GetAllExampleWithPaginate;
use Modules\Example\Domain\Models\Example;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;

/** @implements QueryHandlerInterface<GetAllExampleWithPaginate, LengthAwarePaginator> */
class GetAllExampleWithPaginateHandler implements QueryHandlerInterface
{
    public function __construct(
        private ExampleRepositoryInterface $repository,
    ) {}

    /** @return LengthAwarePaginator<Example> */
    public function handle(GetAllExampleWithPaginate $query): LengthAwarePaginator
    {
        return $this->repository->paginate();
    }
}
