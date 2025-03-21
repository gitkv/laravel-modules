<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Query;

use Modules\Common\Domain\Abstractions\BaseDTO;

/**
 * Абстракция для запросов (CQRS).
 *
 * @template TResponse
 */
abstract class Query extends BaseDTO {}
