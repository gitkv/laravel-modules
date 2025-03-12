<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Command\Middleware;

use Closure;
use Modules\Common\Application\Bus\Command\Command;
use Psr\Log\LoggerInterface;

class LoggingMiddleware
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {}

    public function handle(Command $command, Closure $next): mixed
    {
        $this->logger->info('Command dispatched', [
            'command' => get_class($command),
            'data' => $command->toArray(),
        ]);

        return $next($command);
    }
}
