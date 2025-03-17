<?php

declare(strict_types=1);

namespace Modules\Exp\Infrastructure\Cli;

use Throwable;

class CreateServiceCli extends BaseModuleCli
{
    protected $signature = 'make:module:service
        {module : Module name}
        {name : Service name}
        {--f|force : Overwrite existing files}';

    protected $description = 'Create new service class';

    public function handle(): int
    {
        try {
            $this->validateModule();
            $name = $this->normalizeName($this->argument('name'));

            $path = $this->generateFile(
                'Service',
                "Application/Services/{$name}.php",
                ['**ServiceName**' => $name]
            );

            $this->info("Service [{$name}] created successfully at [{$path}]");

            return self::SUCCESS;

        } catch (Throwable $e) {
            $this->error('Error: '.$e->getMessage());

            return self::FAILURE;
        }
    }
}
