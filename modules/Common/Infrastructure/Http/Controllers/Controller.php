<?php

declare(strict_types=1);

namespace Modules\Common\Infrastructure\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Базовый контроллер с авторизацией и валидацией.
 * Наследует стандартные возможности Laravel Controller.
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Проверяет разрешение для текущего действия
     *
     * @param  array<string, mixed>|object  $arguments
     *
     * @throws AuthorizationException
     */
    protected function authorizeAction(string $ability, array|object $arguments = []): void
    {
        $this->authorize($ability, $arguments);
    }
}
