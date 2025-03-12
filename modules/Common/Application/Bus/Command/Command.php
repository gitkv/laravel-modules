<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Command;

use Modules\Common\Domain\Abstractions\BaseDTO;

/**
 * Абстракция для команд (CQRS).
 */
abstract class Command extends BaseDTO {}
