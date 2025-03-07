<?php
declare(strict_types=1);


namespace Modules;

use Illuminate\Support\ServiceProvider;
use Modules\Example\ExampleModule;

class ModuleServiceProvider extends ServiceProvider
{
    /** @var array<class-string<ModuleInterface>> */
    protected array $modules = [
        ExampleModule::class,
    ];

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
