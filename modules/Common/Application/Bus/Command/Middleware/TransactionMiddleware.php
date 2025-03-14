<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Command\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Modules\Common\Application\Bus\Command\Command;

/**
 * @template TResponse
 */
class TransactionMiddleware
{
    /**
     * @param  Command<TResponse>  $command
     * @return TResponse
     */
    public function handle(Command $command, Closure $next): mixed
    {
        return DB::transaction(fn () => $next($command));
    }
}
