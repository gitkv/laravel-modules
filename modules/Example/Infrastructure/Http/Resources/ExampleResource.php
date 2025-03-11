<?php

declare(strict_types=1);


namespace Modules\Example\Infrastructure\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Example\Domain\Models\Example;

/**
 * @mixin Example
 */
class ExampleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
