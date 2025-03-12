<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Example\Application\DTO\ExampleData;
use Modules\Example\Domain\Models\Example;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;
use Override;

/**
 * Реализация репозитория для работы с Example через Eloquent.
 */
class EloquentExampleRepository implements ExampleRepositoryInterface
{
    #[Override]
    public function create(ExampleData $data): string
    {
        $example = Example::create([
            'name' => $data->name,
            'description' => $data->description,
        ]);

        return (string) $example->id;
    }

    public function getById(string $id): ?Example
    {
        return Example::where('id', $id)->first();
    }

    #[Override]
    public function paginate(int $perPage = 9): LengthAwarePaginator
    {
        return Example::orderBy('created_at', 'asc')->paginate($perPage);
    }
}
