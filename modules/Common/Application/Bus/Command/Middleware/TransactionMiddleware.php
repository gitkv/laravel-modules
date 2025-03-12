<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Command\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Modules\Common\Application\Bus\Command\Command;

class TransactionMiddleware
{
    public function handle(Command $command, Closure $next): mixed
    {
        return DB::transaction(fn () => $next($command));
    }
}
