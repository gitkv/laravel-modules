<?php

declare(strict_types=1);

namespace Modules\Exp\Infrastructure\Cli;

use Throwable;

class CreateCliCommandCli extends BaseModuleCli
{
    protected $signature = 'make:module:cli
        {module : Module name}
        {name : CLI command name}
        {--f|force : Overwrite existing files}';

    protected $description = 'Create new CLI command class';

    public function handle(): int
    {
        try {
            $this->validateModule();

            $name = $this->normalizeName($this->argument('name'));
            $module = $this->moduleName();

            $path = $this->generateFile(
                'CliCommand',
                "Infrastructure/Cli/{$name}.php",
                ['**CliCommandName**' => $name],
            );

            $this->info("CLI command [{$name}] created successfully at [{$path}]");

            $this->showRegistrationExample('cli-command', [
                'ModuleName' => $module,
                'Namespace' => "Modules\\{$module}\\Infrastructure\\Cli",
                'CliCommand' => $name,
            ]);

            return self::SUCCESS;
        } catch (Throwable $e) {
            $this->error('Error: '.$e->getMessage());

            return self::FAILURE;
        }
    }
}
