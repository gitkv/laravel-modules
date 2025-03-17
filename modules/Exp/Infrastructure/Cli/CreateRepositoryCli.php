<?php

declare(strict_types=1);

namespace Modules\Exp\Infrastructure\Cli;

use Throwable;

class CreateRepositoryCli extends BaseModuleCli
{
    protected $signature = 'make:module:repository
        {module : Module name}
        {name : Repository name}
        {--f|force : Overwrite existing files}';

    protected $description = 'Create repository interface and implementation';

    public function handle(): int
    {
        try {
            $this->validateModule();
            $name = $this->normalizeName($this->argument('name'));
            $module = $this->moduleName();

            $interfacePath = $this->generateInterface($name);
            $repoPath = $this->generateImplementation($name);

            $this->info(sprintf(
                "Repository [%s] created successfully. \nRepository: [%s]\nInterfaces: [%s]",
                $name,
                $interfacePath,
                $repoPath
            ));

            $this->showRegistrationExample('repository', [
                'ModuleName' => $module,
                'Namespace' => "Modules\\{$module}",
                'RepositoryInterface' => "{$name}RepositoryInterface",
                'RepositoryImplementation' => "Eloquent{$name}Repository",
            ]);

            return self::SUCCESS;

        } catch (Throwable $e) {
            $this->error('Error: '.$e->getMessage());

            return self::FAILURE;
        }
    }

    private function generateInterface(string $name): string
    {
        return $this->generateFile(
            'RepositoryInterface',
            "Domain/Repositories/{$name}RepositoryInterface.php",
            ['**RepositoryName**' => $name]
        );
    }

    private function generateImplementation(string $name): string
    {
        return $this->generateFile(
            'EloquentRepository',
            "Infrastructure/Repositories/Eloquent{$name}Repository.php",
            ['**RepositoryName**' => $name]
        );
    }
}
