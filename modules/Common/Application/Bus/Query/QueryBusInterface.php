<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Query;

interface QueryBusInterface
{
    public function ask(Query $query): mixed;

    /**
     * @param  array<class-string, class-string>  $map
     */
    public function register(array $map): void;
}
