<?php

declare(strict_types=1);

namespace Modules\Common\Application\Interfaces;

use Modules\Common\Application\Exceptions\DomainException;

/**
 * Интерфейс обработчика запросов.
 * Реализует логику получения данных для конкретного типа запроса.
 */
interface QueryHandlerInterface
{
    /**
     * Выполняет обработку запроса и возвращает результат
     *
     * @template T of QueryInterface
     *
     * @param  T  $query
     *
     * @throws DomainException
     */
    public function handle(QueryInterface $query): mixed;
}
