<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Query;

interface Cacheable
{
    /**
     * @return string Уникальный ключ для кеширования
     */
    public function cacheKey(): string;

    /**
     * @return int Время в секундах
     */
    public function cacheTtlInSec(): int;
}
