<?php

declare(strict_types=1);

namespace Modules\Common\Application\Exceptions;

use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

/**
 * Абстрактное исключение для доменных ошибок.
 * Содержит HTTP-статус и формирует структуру ответа.
 */
abstract class DomainException extends \DomainException implements Responsable
{
    public function __construct(
        string $message = '',
        protected int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR
    ) {
        parent::__construct($message);
    }

    /**
     * Конвертирует исключение в JSON-ответ
     */
    public function toResponse($request): Response
    {
        return response()->json([
            'error' => $this->getMessage(),
            'code' => $this->statusCode,
        ], $this->statusCode);
    }
}
