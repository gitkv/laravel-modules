<?php
declare(strict_types=1);

namespace Modules\Common\Domain\Abstractions;

use JsonSerializable;

abstract class ValueObject implements JsonSerializable
{
    public function equals(self $other): bool
    {
        return get_class($this) === get_class($other) && $this->jsonSerialize() === $other->jsonSerialize();
    }
}
