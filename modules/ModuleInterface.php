<?php

declare(strict_types=1);

namespace Modules;

use Illuminate\Contracts\Foundation\Application;

/**
 * Контракт для всех модулей в системе.
 */
interface ModuleInterface
{
    /**
     * Имя модуля.
     */
    public function name(): string;

    /**
     * Регистрирует модуль в приложении.
     */
    public function register(Application $app): void;

    /**
     * Возвращает список команд, которые должны быть зарегистрированы в приложении.
     *
     * @return class-string[]
     */
    public function getCommands(): array;
}
