<?php

declare(strict_types=1);

namespace Modules\Example\Application\Services;

/**
 * Сервис для работы с бизнес-логикой модуля Example.
 */
class ExampleService
{
    public function getWelcomeMessage(): string
    {
        return 'Welcome to Example Module!';
    }

    public function greet(string $name): string
    {
        return "Hello, $name! From Example Module Service";
    }
}
