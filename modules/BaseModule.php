<?php

declare(strict_types=1);

namespace Modules;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Override;

/**
 * Базовый класс для всех модулей в системе.
 * Предоставляет общую логику для регистрации провайдеров, маршрутов и команд.
 * Каждый модуль должен наследовать этот класс.
 */
abstract class BaseModule implements ModuleInterface
{
    protected Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    #[Override]
    public function registerProviders(): void
    {
        foreach ($this->providers() as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * @return class-string[]
     */
    #[Override]
    public function getCommands(): array
    {
        return $this->commands();
    }

    #[Override]
    public function registerRoutes(): void
    {
        $this->registerWebRoutes();
        $this->registerApiRoutes();
    }

    protected function registerWebRoutes(): void
    {
        Route::middleware('web')
            ->group($this->webRoutesPath());
    }

    protected function registerApiRoutes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->name('api.')
            ->group($this->apiRoutesPath());
    }

    /**
     * Возвращает список сервис-провайдеров модуля.
     *
     * @return class-string[]
     */
    abstract protected function providers(): array;

    /**
     * Возвращает список команд модуля.
     *
     * @return class-string[]
     */
    abstract protected function commands(): array;

    /**
     * Возвращает путь к файлу с веб-маршрутами модуля.
     */
    abstract protected function webRoutesPath(): ?string;

    /**
     * Возвращает путь к файлу с API-маршрутами модуля.
     */
    abstract protected function apiRoutesPath(): ?string;
}
