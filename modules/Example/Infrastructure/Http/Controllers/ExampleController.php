<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Common\Infrastructure\Http\Controllers\Controller;
use Modules\Example\Application\DTO\CreateExampleData;
use Modules\Example\Application\UseCases\CreateExample;
use Modules\Example\Application\UseCases\GetAllExamplesWithPaginate;
use Modules\Example\Infrastructure\Http\Requests\CreateExampleRequest;

class ExampleController extends Controller
{
    public function index(GetAllExamplesWithPaginate $useCase): View
    {
        return view('example::index', [
            'welcomeMessage' => 'Welcome to Example Module!',
            'items' => $useCase->execute(),
        ]);
    }

    public function create(): View
    {
        return view('example::create');
    }

    public function store(CreateExampleRequest $request, CreateExample $useCase): RedirectResponse
    {
        $userData = CreateExampleData::from($request->validated());
        $useCase->execute($userData);

        return redirect(route('example.index'))->withSuccess('Created item successfully');
    }
}
