<?php

declare(strict_types=1);

namespace Modules;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Override;

/**
 * Базовый класс для всех модулей в системе.
 * Предоставляет общую логику для регистрации провайдеров, маршрутов и команд.
 */
abstract class BaseModule implements ModuleInterface
{
    protected static string $modulePath;

    #[Override]
    public function register(Application $app): void
    {
        $this->registerProviders($app);
        $this->registerRoutes();
    }

    protected function registerProviders(Application $app): void
    {
        foreach ($this->getProviders() as $provider) {
            $app->register($provider);
        }
    }

    protected function registerRoutes(): void
    {
        $this->loadRoutesForGroup('web', ['middleware' => 'web']);
        $this->loadRoutesForGroup('api', ['as' => 'api.', 'prefix' => 'api', 'middleware' => 'api']);
    }

    /** @param array<string, string> $options */
    protected function loadRoutesForGroup(string $type, array $options): void
    {
        $path = static::$modulePath."/Infrastructure/Http/Routes/$type.php";

        if (file_exists($path)) {
            Route::group($options, $path);
        }
    }

    /**
     * Возвращает список сервис-провайдеров модуля.
     *
     * @return class-string[]
     */
    abstract protected function getProviders(): array;
}
