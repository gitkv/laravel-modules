<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Query\Middleware;

use Closure;
use Modules\Common\Application\Bus\Query\Query;
use Psr\Log\LoggerInterface;

/**
 * @template TResponse
 */
class QueryLoggingMiddleware
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {}

    /**
     * @param  Query<TResponse>  $query
     * @return TResponse
     */
    public function handle(Query $query, Closure $next): mixed
    {
        $this->logger->info('Query dispatched', [
            'query' => get_class($query),
            'data' => $query->toArray(),
        ]);

        return $next($query);
    }
}
