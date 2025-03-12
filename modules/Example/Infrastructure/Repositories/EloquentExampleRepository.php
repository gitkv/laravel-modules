<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Example\Application\DTO\CreateExampleData;
use Modules\Example\Domain\Models\Example;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;
use Override;

/**
 * Реализация репозитория для работы с Example через Eloquent.
 */
class EloquentExampleRepository implements ExampleRepositoryInterface
{
    #[Override]
    public function create(CreateExampleData $data): Example
    {
        return Example::create([
            'name' => $data->name,
            'description' => $data->description
        ]);
    }

    #[Override]
    public function paginate(int $perPage = 9): LengthAwarePaginator
    {
        return Example::orderBy('created_at', 'asc')->paginate($perPage);
    }
}
