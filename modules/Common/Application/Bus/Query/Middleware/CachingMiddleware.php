<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Query\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Modules\Common\Application\Bus\Query\Cacheable;
use Modules\Common\Application\Bus\Query\Query;

/**
 * @template TResponse
 */
class CachingMiddleware
{
    /**
     * @param  Query<TResponse>  $query
     * @return TResponse
     */
    public function handle(Query $query, Closure $next): mixed
    {
        if ($query instanceof Cacheable) {
            return Cache::remember(
                $query->cacheKey(),
                $query->cacheTtlInSec(),
                fn () => $next($query)
            );
        }

        return $next($query);
    }
}
