<?php

declare(strict_types=1);

namespace Modules\Common\Domain\Abstractions;

use Illuminate\Support\Collection;
use InvalidArgumentException;

/**
 * Абстракция для типизированных коллекций.
 *
 * @template T
 *
 * @extends Collection<int|string, T>
 */
abstract class TypedCollection extends Collection
{
    /**
     * @param  array<int|string, T>  $items
     */
    public function __construct($items = [])
    {
        $items = $this->getArrayableItems($items);
        $this->validateItems($items);
        parent::__construct($items);
    }

    /**
     * @return class-string<T>
     */
    abstract public static function getAllowedType(): string;

    /**
     * Проверяет тип элементов.
     *
     * @param  object[]|class-string[]  $items
     *
     * @throws InvalidArgumentException
     */
    private function validateItems(array $items): void
    {
        $expectedType = static::getAllowedType();

        foreach ($items as $item) {
            if (! $item instanceof $expectedType) {
                $givenType = is_object($item) ? get_class($item) : gettype($item);
                throw new InvalidArgumentException(
                    "Element must be of type {$expectedType}, given: {$givenType}"
                );
            }
        }
    }

    /**
     * @param  T  $item
     */
    public function add($item): static
    {
        $expectedType = static::getAllowedType();

        if (! $item instanceof $expectedType) {
            $givenType = is_object($item) ? get_class($item) : gettype($item);
            throw new InvalidArgumentException(
                'Element must be of type '.$expectedType.", given: {$givenType}"
            );
        }

        return parent::add($item);
    }

    public function push(...$values): static
    {
        foreach ($values as $value) {
            $this->add($value);
        }

        return $this;
    }

    /**
     * @param  int|string  $key
     * @param  T  $value
     */
    public function put($key, $value): static
    {
        $expectedType = static::getAllowedType();

        if (! $value instanceof $expectedType) {
            $givenType = is_object($value) ? get_class($value) : gettype($value);
            throw new InvalidArgumentException(
                'Element must be of type '.$expectedType.", given: {$givenType}"
            );
        }

        return parent::put($key, $value);
    }

    public function merge($items): static
    {
        $items = $this->getArrayableItems($items);
        $this->validateItems($items);

        return parent::merge($items);
    }
}
