<?php

declare(strict_types=1);

namespace Modules\Exp\Infrastructure\Cli;

use Throwable;

class CreateEventCli extends BaseModuleCli
{
    protected $signature = 'make:module:event
        {module : Module name}
        {name : Event name}
        {--f|force : Overwrite existing files}';

    protected $description = 'Create new event class';

    public function handle(): int
    {
        try {
            $this->validateModule();
            $eventName = $this->normalizeName($this->argument('name'));

            $path = $this->generateFile(
                'Event',
                "Application/Events/{$eventName}.php",
                ['**EventName**' => $eventName]
            );

            $this->info("Event [{$eventName}] created successfully at [{$path}]");

            return self::SUCCESS;

        } catch (Throwable $e) {
            $this->error('Error: '.$e->getMessage());

            return self::FAILURE;
        }
    }
}
