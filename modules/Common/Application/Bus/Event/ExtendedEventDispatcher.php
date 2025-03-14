<?php

declare(strict_types=1);

namespace Modules\Common\Application\Bus\Event;

use Closure;
use Illuminate\Events\Dispatcher as BaseDispatcher;
use Override;

class ExtendedEventDispatcher extends BaseDispatcher
{
    /** @var array<class-string> */
    protected array $middleware = [];

    public function addMiddleware(string $middlewareClass): void
    {
        $this->middleware[] = $middlewareClass;
    }

    /** @return array<Closure>|null */
    #[Override]
    public function dispatch($event, $payload = [], $halt = false): ?array
    {
        $eventObject = is_object($event) ? $event : $payload[0] ?? null;

        if ($eventObject instanceof BaseEvent) {
            $middlewareStack = $this->buildMiddlewareStack();

            return $middlewareStack($eventObject);
        }

        return parent::dispatch($event, $payload, $halt);
    }

    private function buildMiddlewareStack(): Closure
    {
        $middleware = array_reverse($this->middleware);

        return array_reduce(
            $middleware,
            function ($next, $middlewareClass) {
                return function ($event) use ($next, $middlewareClass) {
                    $middleware = app($middlewareClass);

                    return $middleware->handle($event, $next);
                };
            },
            function ($event) {
                return parent::dispatch($event);
            }
        );
    }
}
