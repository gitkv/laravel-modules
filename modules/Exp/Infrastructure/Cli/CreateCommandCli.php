<?php

declare(strict_types=1);

namespace Modules\Exp\Infrastructure\Cli;

use Throwable;

class CreateCommandCli extends BaseModuleCli
{
    protected $signature = 'make:module:command
        {module : Module name}
        {name : Command name}
        {--f|force : Overwrite existing files}';

    protected $description = 'Create new command with handler';

    public function handle(): int
    {
        try {
            $this->validateModule();
            $name = $this->normalizeName($this->argument('name'));

            $commandPath = $this->generateCommand($name);
            $handlerPath = $this->generateHandler($name);

            $this->info(sprintf(
                "Command [%s] created successfully. \nCommand: [%s]\nHandler: [%s]",
                $name,
                $commandPath,
                $handlerPath,
            ));

            return self::SUCCESS;

        } catch (Throwable $e) {
            $this->error('Error: '.$e->getMessage());

            return self::FAILURE;
        }
    }

    private function generateCommand(string $name): string
    {
        return $this->generateFile(
            'Command',
            "Application/Commands/{$name}.php",
            ['**CommandName**' => $name]
        );
    }

    private function generateHandler(string $name): string
    {
        return $this->generateFile(
            'CommandHandler',
            "Application/Commands/Handlers/{$name}Handler.php",
            ['**CommandName**' => $name]
        );
    }
}
