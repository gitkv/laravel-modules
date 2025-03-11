<?php

declare(strict_types=1);

namespace Modules\Example\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use Modules\Common\Domain\Abstractions\BaseEntity;
use Modules\Example\Domain\Models\Example;
use Override;

class ExampleEntity extends BaseEntity
{
    public function __construct(
        private string $name,
        private string $description
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ExampleEntity
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): ExampleEntity
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param  array<string, string>  $data
     */
    #[Override]
    public static function fromArray(array $data): BaseEntity
    {
        return new self(
            data_get($data, 'name'),
            data_get($data, 'description')
        );
    }

    #[Override]
    public static function fromModel(Model $model): BaseEntity
    {
        if (! $model instanceof Example) {
            throw new InvalidArgumentException('Expected Example model');
        }

        return new self(
            data_get($model, 'name'),
            data_get($model, 'description')
        );
    }

    #[Override]
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
        ];
    }

    #[Override]
    public function toModel(): Example
    {
        return new Example($this->toArray());
    }
}
