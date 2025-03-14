<?php

declare(strict_types=1);

namespace Modules\Common\Domain\Abstractions;

use Spatie\LaravelData\Data;

/**
 * Базовый DTO.
 * Выступает прослойкой над пакетом spatie/laravel-data.
 *
 * @see https://spatie.be/docs/laravel-data/v4/installation-setup
 */
abstract class BaseDTO extends Data {}
