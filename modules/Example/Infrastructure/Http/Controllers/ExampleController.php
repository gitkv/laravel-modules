<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Common\Application\Bus\Command\CommandBusInterface;
use Modules\Common\Application\Bus\Query\QueryBusInterface;
use Modules\Common\Infrastructure\Http\Controllers\Controller;
use Modules\Example\Application\Commands\CreateExampleItem;
use Modules\Example\Application\Query\GetAllExampleWithPaginate;
use Modules\Example\Infrastructure\Http\Requests\CreateExampleRequest;

class ExampleController extends Controller
{
    public function index(QueryBusInterface $queryBus): View
    {
        return view('example::index', [
            'welcomeMessage' => 'Welcome to Example Module!',
            'items' => $queryBus->ask(new GetAllExampleWithPaginate),
        ]);
    }

    public function create(): View
    {
        return view('example::create');
    }

    public function store(CreateExampleRequest $request, CommandBusInterface $commandBus): RedirectResponse
    {
        $command = CreateExampleItem::from($request->validated());
        $commandBus->dispatch($command);

        return redirect(route('example.index'))->withSuccess('Created item successfully');
    }
}
