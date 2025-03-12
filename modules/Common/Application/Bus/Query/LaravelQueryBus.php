<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Query;

use Illuminate\Bus\Dispatcher;
use Override;

class LaravelQueryBus implements QueryBusInterface
{
    public function __construct(
        private readonly Dispatcher $dispatcher
    ) {}

    #[Override]
    public function ask(Query $query): mixed
    {
        return $this->dispatcher->dispatch($query);
    }

    /**
     * @param  array<class-string, class-string>  $map
     */
    #[Override]
    public function register(array $map): void
    {
        $this->dispatcher->map($map);
    }
}
