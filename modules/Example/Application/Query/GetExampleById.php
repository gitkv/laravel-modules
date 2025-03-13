<?php

declare(strict_types=1);

namespace Modules\Example\Application\Query;

use Modules\Common\Application\Bus\Query\Query;
use Modules\Example\Domain\Models\Example;

/** @implements Query<Example|null> */
class GetExampleById extends Query
{
    public function __construct(
        public string $id,
    ) {}
}
