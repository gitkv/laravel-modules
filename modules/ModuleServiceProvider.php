<?php

declare(strict_types=1);

namespace Modules;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Modules\Common\CommonModule;
use Modules\Example\ExampleModule;
use Modules\Exp\ExpModule;
use Override;

/**
 * Сервис-провайдер, регистрирует все модули в приложении.
 * Автоматически регистрирует маршруты, команды и провайдеры для каждого модуля.
 */
class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Массив классов модулей, которые должны быть зарегистрированы.
     *
     * @var array<class-string<ModuleInterface>>
     */
    private array $modules = [
        ExpModule::class,
        CommonModule::class,
        ExampleModule::class,
    ];

    #[Override]
    public function register(): void
    {
        $commands = [];

        foreach ($this->modules as $moduleClass) {
            $module = new $moduleClass;
            $module->register($this->app);
            $commands = array_merge($commands, $module->getCommands());
        }

        $this->commands($commands);
    }

    public function boot(): void
    {
        Model::preventLazyLoading(! $this->app->isProduction());
        Carbon::setLocale(config('app.locale'));
        setlocale(LC_TIME, '');
    }
}
