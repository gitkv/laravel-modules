<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Event\Middleware;

use Closure;
use Modules\Common\Application\Bus\Event\BaseEvent;
use Psr\Log\LoggerInterface;

class EventLoggingMiddleware
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {}

    public function handle(BaseEvent $event, Closure $next): mixed
    {
        $this->logger->info('Event dispatched', [
            'event' => get_class($event),
            'data' => $event->toArray(),
        ]);

        return $next($event);
    }
}
