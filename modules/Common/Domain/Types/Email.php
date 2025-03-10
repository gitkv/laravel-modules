<?php

declare(strict_types=1);

namespace Modules\Common\Domain\Types;

use Modules\Common\Domain\Abstractions\ValueObject;
use Modules\Common\Domain\Exceptions\IncorrectEmailFormatException;

/**
 * Value-object для работы с email-адресами.
 */
class Email extends ValueObject
{
    private string $value;

    public function __construct(string $value)
    {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new IncorrectEmailFormatException;
        }
        $this->value = $value;
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}
