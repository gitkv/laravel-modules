<?php

declare(strict_types=1);


namespace Modules\Example\Application\DTO;

use Modules\Common\Domain\Abstractions\BaseDTO;

class CreateExampleData extends BaseDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
    ) {}
}
