<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Query;

interface QueryBusInterface
{
    /**
     * @template TResponse
     *
     * @param  Query<TResponse>  $query
     * @return TResponse
     */
    public function ask(Query $query): mixed;

    /**
     * @param  array<class-string, class-string>  $map
     */
    public function register(array $map): void;
}
