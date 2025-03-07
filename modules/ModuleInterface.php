<?php

declare(strict_types=1);

namespace Modules;

use Illuminate\Contracts\Foundation\Application;

interface ModuleInterface
{
    public function name(): string;

    public function register(Application $app): void;

    public function registerRoutes(): void;

    /**
     * @return class-string[]
     */
    public function getCommands(): array;

    public function registerProviders(): void;
}
