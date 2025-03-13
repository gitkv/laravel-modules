<?php

declare(strict_types=1);

namespace Modules\Example\Application\Listeners;

use Modules\Example\Application\Events\ExampleCreated;
use Psr\Log\LoggerInterface;

class LogExampleCreated
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {}

    public function handle(ExampleCreated $event): void
    {
        $this->logger->info('Example log for ExampleCreated event!!!', [
            'event' => get_class($event),
            'data' => $event->toArray(),
        ]);
    }
}
