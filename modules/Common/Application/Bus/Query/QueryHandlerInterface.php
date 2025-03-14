<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Query;

/**
 * Интерфейс обработчика запросов (CQRS).
 *
 * @template TQuery of Query
 * @template TResponse
 */
interface QueryHandlerInterface {}
