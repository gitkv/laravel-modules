<?php

declare(strict_types=1);

namespace Modules\Example\Application\Events;

use Modules\Common\Application\Bus\Event\BaseEvent;

/** @extends BaseEvent<mixed> */
class ExampleCreated extends BaseEvent
{
    public function __construct(
        public readonly string $id,
        public readonly string $name
    ) {}
}
