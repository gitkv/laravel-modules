<?php

declare(strict_types=1);


namespace Modules\Common\Application\Bus\Command;

use Illuminate\Bus\Dispatcher;

class LaravelCommandBus implements CommandBusInterface
{
    public function __construct(
        private readonly Dispatcher $dispatcher
    ) {}

    public function dispatch(Command $command): mixed
    {
        return $this->dispatcher->dispatch($command);
    }

    public function register(array $map): void
    {
        $this->dispatcher->map($map);
    }
}
