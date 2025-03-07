<?php
declare(strict_types=1);

namespace Modules\Example\Infrastructure\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Modules\Example\Application\Services\ExampleService;
use Modules\Example\Application\UseCases\CreateExample;
use Modules\Example\Application\UseCases\GetAllExamples;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;

class ExampleController
{
    public function __construct(
        private ExampleService             $service,
        private ExampleRepositoryInterface $repository
    )
    {
    }

    public function index(GetAllExamples $handler): JsonResponse
    {
        return response()->json($handler->handle());
    }

    public function store(CreateExample $handler): JsonResponse
    {
        $handler->handle(request()->all());
        return response()->json(['status' => 'success']);
    }

    public function view(): View
    {
        return view('example::welcome', [
            'welcomeMessage' => $this->service->getWelcomeMessage(),
            'examples' => $this->repository->getAll()
        ]);
    }
}

