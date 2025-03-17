<?php

declare(strict_types=1);

namespace Modules\Exp\Infrastructure\Cli;

use Throwable;

class CreateControllerCli extends BaseModuleCli
{
    protected $signature = 'make:module:controller
        {module : Module name}
        {name : Controller name}
        {--f|force : Overwrite existing files}';

    protected $description = 'Create new controller class';

    public function handle(): int
    {
        try {
            $this->validateModule();
            $name = $this->normalizeName($this->argument('name'));

            $path = $this->generateFile(
                'Controller',
                "Infrastructure/Http/Controllers/{$name}.php",
                ['**ControllerName**' => $name]
            );

            $this->info("Controller [{$name}] created successfully at [{$path}]");

            return self::SUCCESS;

        } catch (Throwable $e) {
            $this->error('Error: '.$e->getMessage());

            return self::FAILURE;
        }
    }
}
