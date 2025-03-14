<?php

declare(strict_types=1);

namespace Modules\Example\Application\Events;

use Modules\Common\Application\Bus\Event\BaseEvent;
use Modules\Example\Domain\Models\Example;

/** @extends BaseEvent<mixed> */
class ExampleCreated extends BaseEvent
{
    public function __construct(
        public readonly Example $item
    ) {}
}
