<?php

declare(strict_types=1);

namespace Modules\Example\Application\Commands;

use Modules\Common\Application\Bus\Command\Command;

/** @implements Command<string> */
class CreateExampleItem extends Command
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
    ) {}
}
