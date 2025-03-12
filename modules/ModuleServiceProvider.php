<?php

declare(strict_types=1);

namespace Modules;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use Modules\Common\CommonModule;
use Modules\Example\ExampleModule;
use Override;

/**
 * Сервис-провайдер, который регистрирует все модули в приложении.
 * Автоматически регистрирует маршруты, команды и провайдеры для каждого модуля.
 */
class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Массив классов модулей, которые должны быть зарегистрированы.
     *
     * @var array<class-string<ModuleInterface>>
     */
    protected array $modules = [
        CommonModule::class,
        ExampleModule::class,
    ];

    /**
     * Массив классов модулей, которые должны быть зарегистрированы.
     *
     * @throws BindingResolutionException
     */
    #[Override]
    public function register(): void
    {
        $commands = [];
        foreach ($this->modules as $moduleClass) {
            /** @var ModuleInterface $module */
            $module = $this->app->make($moduleClass);

            $module->register($this->app);
            $module->registerProviders();
            $module->registerRoutes();
            $commands = array_merge($commands, $module->getCommands());
        }

        $this->commands($commands);
    }
}
