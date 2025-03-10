<?php

declare(strict_types=1);

namespace Modules\Common\Infrastructure\Helpers;

use Illuminate\Support\Facades\Gate;
use Modules\Common\Application\Exceptions\UnauthorizedException;

/**
 * Хелпер для авторизации действий.
 * Интегрируется с Laravel Gates и Policies.
 */
class Authorization
{
    /**
     * Проверяет разрешение на действие
     *
     * @param  array<string, mixed>|object  $arguments
     */
    public static function check(string $ability, array|object $arguments = []): void
    {
        if (Gate::denies($ability, $arguments)) {
            throw new UnauthorizedException("Cannot perform {$ability}");
        }
    }

    /**
     * Разрешает действие, если условие выполнено.
     */
    public static function allowIf(bool $condition, string $message = ''): void
    {
        if (! $condition) {
            throw new UnauthorizedException($message);
        }
    }
}
