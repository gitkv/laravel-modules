<?php

declare(strict_types=1);

namespace Modules\Example\Domain\Repositories;

use Modules\Example\Domain\Models\Example;

interface ExampleRepositoryInterface
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): void;

    /**
     * @return array<Example>
     */
    public function getAll(): array;
}
