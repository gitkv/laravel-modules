<?php
declare(strict_types=1);

namespace Modules\Common\Domain\Exceptions;

use DomainException;

class IncorrectEmailFormatException extends DomainException
{
    public function __construct(string $message = 'Invalid email format')
    {
        parent::__construct($message);
    }
}
