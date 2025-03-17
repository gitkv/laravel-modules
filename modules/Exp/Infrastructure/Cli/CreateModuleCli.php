<?php

declare(strict_types=1);

namespace Modules\Exp\Infrastructure\Cli;

use Illuminate\Support\Facades\File;
use RuntimeException;
use Throwable;

class CreateModuleCli extends BaseModuleCli
{
    protected $signature = 'make:module
        {module : Module name}
        {--f|force : Overwrite existing files}';

    protected $description = 'Create new module structure';

    private const DIRECTORIES = [
        'Application/Commands/Handlers',
        'Application/DTO',
        'Application/Events',
        'Application/Listeners',
        'Application/Queries/Handlers',
        'Application/Services',
        'Domain/Collections',
        'Domain/Models',
        'Domain/Repositories',
        'Infrastructure/Cli',
        'Infrastructure/Http/Controllers',
        'Infrastructure/Http/Requests',
        'Infrastructure/Http/Resources',
        'Infrastructure/Http/Routes',
        'Infrastructure/Providers',
        'Infrastructure/Repositories',
        'Infrastructure/Resources/Views',
    ];

    public function handle(): int
    {
        try {
            $name = $this->moduleName();

            if ($this->moduleManager->exists($name) && ! $this->option('force')) {
                if (! $this->confirm("Module [{$name}] already exists. Do you want to overwrite its files?")) {
                    throw new RuntimeException('Module creation cancelled');
                }
            }

            $this->createStructure($name);
            $this->generateCoreFiles($name);

            $this->moduleManager->flushCache();

            $this->info("Module [{$name}] created successfully");

            $this->showRegistrationExample('module', [
                'ModuleName' => $name,
            ]);

            return self::SUCCESS;
        } catch (Throwable $e) {
            $this->error('Error: '.$e->getMessage());

            return self::FAILURE;
        }
    }

    private function createStructure(string $name): void
    {
        foreach (self::DIRECTORIES as $dir) {
            $path = "modules/{$name}/{$dir}";
            File::ensureDirectoryExists($path);
            if (! File::isDirectory($path)) {
                throw new RuntimeException("Failed to create directory: {$path}");
            }
        }
    }

    private function generateCoreFiles(string $name): void
    {
        $this->generateFile('Module', "{$name}Module.php");
        $this->generateFile('ServiceProvider', "Infrastructure/Providers/{$name}ServiceProvider.php");
    }
}
