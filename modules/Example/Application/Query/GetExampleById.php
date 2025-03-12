<?php

declare(strict_types=1);

namespace Modules\Example\Application\Query;

use Modules\Common\Application\Bus\Query\Query;

class GetExampleById extends Query
{
    public function __construct(
        public string $id,
    ) {}
}
