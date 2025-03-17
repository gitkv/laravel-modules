<?php

declare(strict_types=1);

namespace Modules\Example;

use Modules\BaseModule;
use Modules\Example\Infrastructure\Cli\ExampleCreateItemCli;
use Modules\Example\Infrastructure\Providers\EventServiceProvider;
use Modules\Example\Infrastructure\Providers\ExampleServiceProvider;
use Override;

/**
 * Демонстрационный модуль Example.
 */
class ExampleModule extends BaseModule
{
    protected static string $modulePath = __DIR__;

    #[Override]
    public function name(): string
    {
        return 'Example';
    }

    #[Override]
    public function getCommands(): array
    {
        return [
            ExampleCreateItemCli::class,
        ];
    }

    #[Override]
    protected function getProviders(): array
    {
        return [
            ExampleServiceProvider::class,
            EventServiceProvider::class,
        ];
    }
}
