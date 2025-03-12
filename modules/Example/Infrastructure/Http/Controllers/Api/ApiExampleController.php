<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Common\Application\Bus\Command\CommandBusInterface;
use Modules\Common\Infrastructure\Http\Controllers\Controller;
use Modules\Example\Application\Commands\CreateExampleItem;
use Modules\Example\Application\UseCases\GetAllExamplesWithPaginate;
use Modules\Example\Infrastructure\Http\Requests\CreateExampleRequest;
use Modules\Example\Infrastructure\Http\Resources\ExampleCollectionResource;
use Modules\Example\Infrastructure\Http\Resources\ExampleResource;

class ApiExampleController extends Controller
{
    public function index(Request $request, GetAllExamplesWithPaginate $useCase): ExampleCollectionResource
    {
        $paginator = $useCase->execute();

        return new ExampleCollectionResource($paginator);
    }

    public function store(CreateExampleRequest $request, CommandBusInterface $commandBus): ExampleResource
    {
        $command = CreateExampleItem::from($request->validated());
        $id = $commandBus->dispatch($command);

        return new ExampleResource($item);
    }
}
