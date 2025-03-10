<?php

declare(strict_types=1);

namespace Modules\Example\Domain\Repositories;

use Modules\Example\Domain\Collections\ExampleCollection;

/**
 * Интерфейс репозитория для работы с Example.
 */
interface ExampleRepositoryInterface
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): void;

    /**
     * @return ExampleCollection
     */
    public function getAll(): ExampleCollection;
}
