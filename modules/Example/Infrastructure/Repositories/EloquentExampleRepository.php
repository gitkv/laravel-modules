<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Example\Domain\Collections\ExampleCollection;
use Modules\Example\Domain\Models\Example;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;
use Override;

/**
 * Реализация репозитория для работы с Example через Eloquent.
 */
class EloquentExampleRepository implements ExampleRepositoryInterface
{
    /**
     * @param  array<string, mixed>  $data
     */
    #[Override]
    public function create(array $data): Example
    {
        return Example::create($data);
    }

    #[Override]
    public function getAll(): ExampleCollection
    {
        return ExampleCollection::make(Example::all()->toBase());
    }

    #[Override]
    public function getAllWithPaginate(int $perPage = 10): LengthAwarePaginator
    {
        return Example::orderBy('created_at', 'asc')->paginate($perPage);
    }
}
