<?php

declare(strict_types=1);

namespace Modules\Example;

use Illuminate\Contracts\Foundation\Application;
use Modules\BaseModule;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;
use Modules\Example\Infrastructure\Cli\ExampleCommand;
use Modules\Example\Infrastructure\Providers\ExampleServiceProvider;
use Modules\Example\Infrastructure\Repositories\EloquentExampleRepository;
use Override;

/**
 * Демонстрационный модуль Example.
 */
class ExampleModule extends BaseModule
{
    #[Override]
    public function name(): string
    {
        return 'Example';
    }

    #[Override]
    protected function providers(): array
    {
        return [ExampleServiceProvider::class];
    }

    #[Override]
    protected function commands(): array
    {
        return [ExampleCommand::class];
    }

    #[Override]
    protected function webRoutesPath(): ?string
    {
        return __DIR__.'/Infrastructure/Http/Routes/web.php';
    }

    #[Override]
    protected function apiRoutesPath(): ?string
    {
        return __DIR__.'/Infrastructure/Http/Routes/api.php';
    }

    #[Override]
    public function register(Application $app): void
    {
        $app->singleton(
            ExampleRepositoryInterface::class,
            EloquentExampleRepository::class
        );
    }
}
