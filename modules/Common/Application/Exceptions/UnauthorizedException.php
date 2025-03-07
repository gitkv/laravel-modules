<?php
declare(strict_types=1);

namespace Modules\Common\Application\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class UnauthorizedException extends DomainException
{
    public function __construct(string $message = 'Forbidden')
    {
        parent::__construct($message, Response::HTTP_FORBIDDEN);
    }
}
