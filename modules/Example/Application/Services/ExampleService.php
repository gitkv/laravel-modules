<?php

declare(strict_types=1);

namespace Modules\Example\Application\Services;

use Carbon\CarbonImmutable;
use Illuminate\Support\Str;

/**
 * Сервис для работы с бизнес-логикой модуля Example.
 */
class ExampleService
{
    public function generateSlug(string $name): string
    {
        $datetime = CarbonImmutable::now();

        return Str::slug(
            sprintf(
                '%s-%s',
                $name,
                $datetime->timestamp
            )
        );
    }
}
