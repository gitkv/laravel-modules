<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Command;

interface CommandBusInterface
{
    /**
     * @template TResponse
     *
     * @param  Command<TResponse>  $command
     * @return TResponse
     */
    public function dispatch(Command $command): mixed;

    /**
     * @param  array<class-string, class-string>  $map
     */
    public function register(array $map): void;
}
