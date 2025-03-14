<?php

declare(strict_types=1);

namespace Modules\Example\Application\Query;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Common\Application\Bus\Query\Query;

/** @extends Query<LengthAwarePaginator> */
class GetAllExampleWithPaginate extends Query {}
