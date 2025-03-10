<?php

declare(strict_types=1);

namespace Modules\Common\Application\Exceptions;

use Symfony\Component\HttpFoundation\Response;

/**
 * Исключение при отказах в авторизации.
 * Автоматически устанавливает HTTP-статус 403.
 */
class UnauthorizedException extends DomainException
{
    public function __construct(string $message = 'Forbidden')
    {
        parent::__construct($message, Response::HTTP_FORBIDDEN);
    }
}
