<?php
declare(strict_types=1);

namespace Modules\Example;

use Illuminate\Contracts\Foundation\Application;
use Modules\BaseModule;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;
use Modules\Example\Infrastructure\Commands\ExampleCommand;
use Modules\Example\Infrastructure\Providers\ExampleServiceProvider;
use Modules\Example\Infrastructure\Repositories\EloquentExampleRepository;

class ExampleModule extends BaseModule
{
    public function name(): string
    {
        return 'Example';
    }

    protected function providers(): array
    {
        return [ExampleServiceProvider::class];
    }

    protected function commands(): array
    {
        return [ExampleCommand::class];
    }

    protected function webRoutesPath(): string
    {
        return __DIR__ . '/Infrastructure/Routes/web.php';
    }

    protected function apiRoutesPath(): string
    {
        return __DIR__ . '/Infrastructure/Routes/api.php';
    }

    public function register(Application $app): void
    {
        $app->singleton(
            ExampleRepositoryInterface::class,
            EloquentExampleRepository::class
        );
    }
}
