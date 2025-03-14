<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Command;

use Override;

class LaravelCommandBus implements CommandBusInterface
{
    public function __construct(
        private readonly CommandDispatcher $dispatcher,
    ) {}

    #[Override]
    public function dispatch(Command $command): mixed
    {
        return $this->dispatcher->dispatch($command);
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
