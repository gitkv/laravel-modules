<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Query\Middleware;

use Closure;
use Modules\Common\Application\Bus\Query\Query;
use Psr\Log\LoggerInterface;

class QueryLoggingMiddleware
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {}

    public function handle(Query $query, Closure $next): mixed
    {
        $this->logger->info('Query dispatched', [
            'query' => get_class($query),
            'data' => $query->toArray(),
        ]);

        return $next($query);
    }
}
