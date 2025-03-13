<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Http\Controllers\Api;

use Modules\Common\Application\Bus\Command\CommandBusInterface;
use Modules\Common\Application\Bus\Query\QueryBusInterface;
use Modules\Common\Infrastructure\Http\Controllers\Controller;
use Modules\Example\Application\Commands\CreateExampleItem;
use Modules\Example\Application\Query\GetAllExampleWithPaginate;
use Modules\Example\Application\Query\GetExampleById;
use Modules\Example\Domain\Models\Example;
use Modules\Example\Infrastructure\Http\Requests\CreateExampleRequest;
use Modules\Example\Infrastructure\Http\Resources\ExampleCollectionResource;
use Modules\Example\Infrastructure\Http\Resources\ExampleResource;

class ApiExampleController extends Controller
{
    public function index(QueryBusInterface $queryBus): ExampleCollectionResource
    {
        $paginate = $queryBus->ask(new GetAllExampleWithPaginate);

        return new ExampleCollectionResource($paginate);
    }

    public function store(
        CreateExampleRequest $request,
        CommandBusInterface $commandBus,
        QueryBusInterface $queryBus,
    ): ExampleResource {

        /** @var string $id */
        $id = $commandBus->dispatch(
            new CreateExampleItem(...$request->validated())
        );

        /** @var Example $exampleItem */
        $exampleItem = $queryBus->ask(new GetExampleById(id: $id));

        return new ExampleResource($exampleItem);
    }
}
