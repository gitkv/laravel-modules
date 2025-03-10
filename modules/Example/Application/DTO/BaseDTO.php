<?php

declare(strict_types=1);

namespace Modules\Example\Application\DTO;

/**
 * Базовый класс для DTO (Data Transfer Object).
 */
abstract class BaseDTO
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
