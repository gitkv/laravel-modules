<?php
declare(strict_types=1);

namespace Modules\Common\Application\Interfaces;

use Modules\Common\Application\Exceptions\DomainException;

interface CommandHandlerInterface
{
    /**
     * @template T of CommandInterface
     * @param T $command
     * @return void
     * @throws DomainException
     */
    public function handle(CommandInterface $command): void;
}
