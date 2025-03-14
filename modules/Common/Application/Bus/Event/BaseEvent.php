<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Event;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Common\Domain\Abstractions\BaseDTO;

/**
 * Абстракция для доменных событий.
 *
 * @template TResponse
 */
abstract class BaseEvent extends BaseDTO
{
    use Dispatchable, SerializesModels;
}
