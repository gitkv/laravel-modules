<?php

declare(strict_types=1);

namespace Modules\Common\Domain\Abstractions;

use Illuminate\Database\Eloquent\Model;
use JsonSerializable;
use Override;

/**
 * Абстракция для сущностей предметной области.
 *
 * @template T
 */
abstract class BaseEntity implements JsonSerializable
{
    abstract public static function fromArray(array $data): self;

    abstract public static function fromModel(Model $model): self;

    /**
     * @return array<string, T>
     */
    abstract public function toArray(): array;

    abstract public function toModel(): Model;

    /**
     * @return array<string, T>
     */
    #[Override]
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
