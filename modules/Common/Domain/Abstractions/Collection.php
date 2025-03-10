<?php

declare(strict_types=1);

namespace Modules\Common\Domain\Abstractions;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

/**
 * Абстрактный класс для коллекций.
 * Предоставляет базовую функциональность для работы с коллекциями объектов.
 *
 * @template TKey of array-key
 * @template TValue
 *
 * @implements IteratorAggregate<TKey, TValue>
 */
abstract class Collection implements IteratorAggregate
{
    /** @param array<TKey, TValue> $items */
    public function __construct(protected array $items = []) {}

    /** @return Traversable<TKey, TValue> */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }
}
