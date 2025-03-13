<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Event;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Common\Domain\Abstractions\BaseDTO;

abstract class BaseEvent extends BaseDTO
{
    use Dispatchable, SerializesModels;
}
