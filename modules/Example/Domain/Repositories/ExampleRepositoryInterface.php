<?php

declare(strict_types=1);

namespace Modules\Example\Domain\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Example\Domain\Collections\ExampleCollection;
use Modules\Example\Domain\Models\Example;

/**
 * Интерфейс репозитория для работы с Example.
 */
interface ExampleRepositoryInterface
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Example;

    public function getAll(): ExampleCollection;

    public function getAllWithPaginate(int $perPage = 10): LengthAwarePaginator;
}
