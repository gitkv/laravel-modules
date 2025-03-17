<?php

declare(strict_types=1);

namespace Modules\Exp;

use Modules\BaseModule;
use Modules\Exp\Infrastructure\Cli\CreateCliCommandCli;
use Modules\Exp\Infrastructure\Cli\CreateCommandCli;
use Modules\Exp\Infrastructure\Cli\CreateControllerCli;
use Modules\Exp\Infrastructure\Cli\CreateDtoCli;
use Modules\Exp\Infrastructure\Cli\CreateEventCli;
use Modules\Exp\Infrastructure\Cli\CreateListenerCli;
use Modules\Exp\Infrastructure\Cli\CreateModuleCli;
use Modules\Exp\Infrastructure\Cli\CreateQueryCli;
use Modules\Exp\Infrastructure\Cli\CreateRepositoryCli;
use Modules\Exp\Infrastructure\Cli\CreateRouteCli;
use Modules\Exp\Infrastructure\Cli\CreateServiceCli;

class ExpModule extends BaseModule
{
    protected static string $modulePath = __DIR__;

    public function name(): string
    {
        return 'Exp';
    }

    protected function getProviders(): array
    {
        return [];
    }

    public function getCommands(): array
    {
        return [
            CreateModuleCli::class,
            CreateCliCommandCli::class,
            CreateControllerCli::class,
            CreateCommandCli::class,
            CreateRepositoryCli::class,
            CreateServiceCli::class,
            CreateDtoCli::class,
            CreateQueryCli::class,
            CreateEventCli::class,
            CreateListenerCli::class,
            CreateRouteCli::class,
        ];
    }
}
