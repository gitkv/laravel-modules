<?php

declare(strict_types=1);


namespace Modules\Common\Application\Bus\Command;

interface CommandBusInterface
{
    public function dispatch(Command $command): mixed;

    public function register(array $map): void;
}
