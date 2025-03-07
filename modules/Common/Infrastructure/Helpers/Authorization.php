<?php

declare(strict_types=1);

namespace Modules\Common\Infrastructure\Helpers;

use Illuminate\Support\Facades\Gate;
use Modules\Common\Application\Exceptions\UnauthorizedException;

class Authorization
{
    /**
     * @param  array<string, mixed>|object  $arguments
     */
    public static function check(string $ability, array|object $arguments = []): void
    {
        if (Gate::denies($ability, $arguments)) {
            throw new UnauthorizedException("Cannot perform {$ability}");
        }
    }

    public static function allowIf(bool $condition, string $message = ''): void
    {
        if (! $condition) {
            throw new UnauthorizedException($message);
        }
    }
}
