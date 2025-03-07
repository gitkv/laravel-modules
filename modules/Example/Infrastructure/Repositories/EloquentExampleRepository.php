<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Repositories;

use Modules\Example\Domain\Models\Example;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;

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
     * @return array<Example>
     */
    public function getAll(): array
    {
        return Example::all()->toArray();
    }
}
