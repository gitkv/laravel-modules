<?php

declare(strict_types=1);

namespace Modules\Exp\Infrastructure\Cli;

use Throwable;

class CreateDtoCli extends BaseModuleCli
{
    protected $signature = 'make:module:dto
        {module : Module name}
        {name : DTO name}
        {--f|force : Overwrite existing files}';

    protected $description = 'Create new DTO class';

    public function handle(): int
    {
        try {
            $this->validateModule();
            $name = $this->normalizeName($this->argument('name'));

            $path = $this->generateFile(
                'Dto',
                "Application/DTO/{$name}.php",
                ['**DtoName**' => $name]
            );

            $this->info("DTO [{$name}] created successfully at [{$path}]");

            return self::SUCCESS;

        } catch (Throwable $e) {
            $this->error('Error: '.$e->getMessage());

            return self::FAILURE;
        }
    }
}
