<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Common\Infrastructure\Http\Controllers\Controller;
use Modules\Example\Application\Services\ExampleService;
use Modules\Example\Application\UseCases\CreateExample;
use Modules\Example\Application\UseCases\GetAllExamples;
use Modules\Example\Domain\Repositories\ExampleRepositoryInterface;
use Modules\Example\Infrastructure\Requests\CreateExampleRequest;

class ExampleController extends Controller
{
    public function __construct(
        private ExampleService $service
    ) {}

    public function index(GetAllExamples $handler): View
    {
        return view('example::index', [
            'welcomeMessage' => $this->service->getWelcomeMessage(),
            'examples' => $handler->handle(),
        ]);
    }

    public function create(): View
    {
        return view('example::create');
    }

    public function store(CreateExampleRequest $request, CreateExample $handler): RedirectResponse
    {
        $handler->handle($request->validated());

        return redirect(route('example.index'))->withSuccess('Created example successfully');
    }
}
