<?php
declare(strict_types=1);

namespace Modules\Common\Application\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class DomainExceptionHandler extends ExceptionHandler
{
    public function render($request, Throwable $e): Response
    {
        if ($e instanceof DomainException) {
            return $e->toResponse($request);
        }

        return parent::render($request, $e);
    }
}
