<?php

declare(strict_types=1);

namespace Modules;

use Illuminate\Contracts\Foundation\Application;

/**
 * Контракт для всех модулей в системе.
 * Каждый модуль должен реализовать этот интерфейс.
 */
interface ModuleInterface
{
    /**
     * Возвращает имя модуля.
     */
    public function name(): string;

    /**
     * Регистрирует модуль в приложении.
     */
    public function register(Application $app): void;

    /**
     * Регистрирует маршруты модуля.
     */
    public function registerRoutes(): void;

    /**
     * Возвращает список команд, которые должны быть зарегистрированы в приложении.
     *
     * @return class-string[]
     */
    public function getCommands(): array;

    /**
     * Регистрирует сервис-провайдеры модуля.
     */
    public function registerProviders(): void;
}
