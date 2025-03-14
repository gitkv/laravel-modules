<?php

declare(strict_types=1);

namespace Modules\Common;

use Modules\BaseModule;
use Modules\Common\Infrastructure\Providers\BusServiceProvider;
use Modules\Common\Infrastructure\Providers\CommonServiceProvider;
use Override;

/**
 * Модуль ядра.
 */
class CommonModule extends BaseModule
{
    protected static string $modulePath = __DIR__;

    #[Override]
    public function name(): string
    {
        return 'Common';
    }

    #[Override]
    public function getCommands(): array
    {
        return [];
    }

    #[Override]
    protected function getProviders(): array
    {
        return [
            BusServiceProvider::class,
            CommonServiceProvider::class,
        ];
    }
}
