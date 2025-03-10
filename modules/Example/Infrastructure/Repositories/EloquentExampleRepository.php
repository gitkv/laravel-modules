<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Repositories;

use Modules\Example\Domain\Collections\ExampleCollection;
use Modules\Example\Domain\Models\Example;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;

/**
 * Реализация репозитория для работы с Example через Eloquent.
 */
class EloquentExampleRepository implements ExampleRepositoryInterface
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): void
    {
        Example::create($data);
    }

    /**
     * @return ExampleCollection
     */
    public function getAll(): ExampleCollection
    {
        return new ExampleCollection(Example::all()->all());
    }
}
