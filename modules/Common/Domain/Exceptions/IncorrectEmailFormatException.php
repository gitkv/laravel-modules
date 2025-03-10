<?php

declare(strict_types=1);

namespace Modules\Common\Domain\Exceptions;

use Modules\Common\Application\Exceptions\DomainException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Исключение при некорректном формате email.
 */
class IncorrectEmailFormatException extends DomainException
{
    public function __construct(string $message = 'Invalid email format')
    {
        parent::__construct($message, Response::HTTP_BAD_REQUEST);
    }
}
