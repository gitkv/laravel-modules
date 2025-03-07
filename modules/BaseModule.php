<?php
declare(strict_types=1);

namespace Modules;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Route;

abstract class BaseModule implements ModuleInterface
{
    protected Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function registerProviders(): void
    {
        foreach ($this->providers() as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * @return class-string[]
     */
    public function getCommands(): array
    {
        return $this->commands();
    }

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
            ->group($this->apiRoutesPath());
    }

    /** @return class-string[] */
    abstract protected function providers(): array;

    /** @return class-string[] */
    abstract protected function commands(): array;

    abstract protected function webRoutesPath(): string;

    abstract protected function apiRoutesPath(): string;
}
