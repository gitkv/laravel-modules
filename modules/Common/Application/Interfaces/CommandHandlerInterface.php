<?php

declare(strict_types=1);

namespace Modules\Common\Application\Interfaces;

use Modules\Common\Application\Exceptions\DomainException;

/**
 * Интерфейс обработчика команд.
 * Определяет контракт для классов, обрабатывающих команды приложения.
 */
interface CommandHandlerInterface
{
    /**
     * Обрабатывает команду.
     *
     * @template T of CommandInterface
     *
     * @param  T  $command
     *
     * @throws DomainException
     */
    public function handle(CommandInterface $command): void;
}
