<?php
declare(strict_types=1);

namespace Modules\Common\Domain\Abstractions;

use JsonSerializable;

/**
 * @template T
 */
abstract class Entity implements JsonSerializable
{
    /**
     * @return array<string, T>
     */
    abstract public function toArray(): array;

    /**
     * @return array<string, T>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
