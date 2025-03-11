<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Common\Infrastructure\Http\Controllers\Controller;
use Modules\Example\Application\UseCases\CreateExample;
use Modules\Example\Application\UseCases\GetAllExamplesWithPaginate;
use Modules\Example\Infrastructure\Http\Requests\CreateExampleRequest;
use Modules\Example\Infrastructure\Http\Resources\ExampleCollectionResource;
use Modules\Example\Infrastructure\Http\Resources\ExampleResource;

class ApiExampleController extends Controller
{
    public function index(Request $request, GetAllExamplesWithPaginate $handler): ExampleCollectionResource
    {
        $paginator = $handler->handle();

        return new ExampleCollectionResource($paginator);
    }

    public function store(CreateExampleRequest $request, CreateExample $handler): ExampleResource
    {
        $item = $handler->handle($request->validated());

        return new ExampleResource($item);
    }
}
