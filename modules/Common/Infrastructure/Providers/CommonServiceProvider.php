<?php

declare(strict_types=1);

namespace Modules\Common\Infrastructure\Providers;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\Common\Application\Exceptions\DomainExceptionHandler;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;
use Modules\Example\Infrastructure\Repositories\EloquentExampleRepository;

/**
 * Базовый провайдер для общих сервисов.
 * Регистрирует обработчик исключений и политики доступа.
 */
class CommonServiceProvider extends ServiceProvider
{
    public $singletons = [
        ExceptionHandler::class => DomainExceptionHandler::class,
        ExampleRepositoryInterface::class => EloquentExampleRepository::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }

    protected function registerPolicies(): void
    {
        if (config()->has('common.policies')) {
            foreach (config('common.policies', []) as $model => $policy) {
                if (class_exists($policy)) {
                    Gate::policy($model, $policy);
                }
            }
        }
    }
}
