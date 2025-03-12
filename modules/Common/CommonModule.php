<?php

declare(strict_types=1);

namespace Modules\Common;

use Illuminate\Contracts\Foundation\Application;
use Modules\BaseModule;
use Modules\Common\Infrastructure\Providers\BusServiceProvider;
use Modules\Common\Infrastructure\Providers\CommonServiceProvider;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;
use Modules\Example\Infrastructure\Repositories\EloquentExampleRepository;
use Override;

/**
 * Модуль ядра.
 */
class CommonModule extends BaseModule
{
    #[Override]
    public function name(): string
    {
        return 'Common';
    }

    #[Override]
    protected function providers(): array
    {
        return [
            BusServiceProvider::class,
            CommonServiceProvider::class,
        ];
    }

    #[Override]
    protected function commands(): array
    {
        return [];
    }

    #[Override]
    protected function webRoutesPath(): ?string
    {
        return null;
    }

    #[Override]
    protected function apiRoutesPath(): ?string
    {
        return null;
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
