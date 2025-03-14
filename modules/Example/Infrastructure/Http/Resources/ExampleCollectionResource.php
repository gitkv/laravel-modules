<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Example\Domain\Models\Example;
use Override;

/**
 * @mixin Example
 */
class ExampleCollectionResource extends ResourceCollection
{

    public $collects = ExampleResource::class;

    /** @return array{data: ExampleResource[]} */
    #[Override]
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->all(),
        ];
    }
}
