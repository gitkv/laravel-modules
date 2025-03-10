<?php

declare(strict_types=1);

namespace Modules\Common\Application\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Базовый обработчик исключений доменной логики.
 * Конвертирует исключения в HTTP-ответы формата JSON.
 */
class DomainExceptionHandler extends ExceptionHandler
{
    /**
     * Преобразует исключение в JSON-ответ
     *
     * @throws Throwable
     */
    public function render($request, Throwable $e): Response
    {
        if ($e instanceof DomainException) {
            return $e->toResponse($request);
        }

        return parent::render($request, $e);
    }
}
