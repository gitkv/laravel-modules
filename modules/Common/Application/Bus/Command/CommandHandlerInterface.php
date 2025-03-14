<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Command;

/**
 * Интерфейс обработчика команд (CQRS).
 * Поддерживает использование laravel очередей: имплементировать ShouldQueue в реализации.
 *
 * @template TCommand of Command
 * @template TResponse
 */
interface CommandHandlerInterface {}
