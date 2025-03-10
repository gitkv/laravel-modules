<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Modules\Common\Infrastructure\Http\Controllers\Controller;
use Modules\Example\Application\UseCases\CreateExample;
use Modules\Example\Application\UseCases\GetAllExamples;
use Modules\Example\Infrastructure\Requests\CreateExampleRequest;

class ApiExampleController extends Controller
{
    public function index(GetAllExamples $handler): JsonResponse
    {
        return response()->success($handler->handle());
    }

    public function store(CreateExampleRequest $request, CreateExample $handler): JsonResponse
    {
        $handler->handle($request->validated());

        return response()->success(['status' => 'success']);
    }
}
