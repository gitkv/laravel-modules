<?php

declare(strict_types=1);

namespace Modules\Example\Domain\Collections;

use Modules\Common\Domain\Abstractions\TypedCollection;
use Modules\Example\Domain\Models\Example;

/**
 * @extends TypedCollection<Example>
 */
class ExampleCollection extends TypedCollection
{
    public static function getAllowedType(): string
    {
        return Example::class;
    }

    public function findByName(string $name): self
    {
        return $this->filter(fn (Example $e) => $e->name === $name);
    }
}
