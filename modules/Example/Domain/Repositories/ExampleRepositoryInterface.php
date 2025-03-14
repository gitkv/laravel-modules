<?php

declare(strict_types=1);

namespace Modules\Example\Domain\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Example\Application\DTO\ExampleData;
use Modules\Example\Domain\Models\Example;

/**
 * Интерфейс репозитория для работы с Example.
 */
interface ExampleRepositoryInterface
{
    public function create(ExampleData $data): Example;
    public function getById(string $id): ?Example;

    /** @return LengthAwarePaginator<Example> */
    public function paginate(int $perPage = 9): LengthAwarePaginator;
}
