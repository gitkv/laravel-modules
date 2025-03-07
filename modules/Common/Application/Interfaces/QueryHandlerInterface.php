<?php
declare(strict_types=1);

namespace Modules\Common\Application\Interfaces;

use Modules\Common\Application\Exceptions\DomainException;

interface QueryHandlerInterface
{
    /**
     * @template T of QueryInterface
     * @param T $query
     * @return mixed
     * @throws DomainException
     */
    public function handle(QueryInterface $query): mixed;
}
