<?php

declare(strict_types=1);

namespace Modules\Exp\Infrastructure\Cli;

use Throwable;

class CreateQueryCli extends BaseModuleCli
{
    protected $signature = 'make:module:query
        {module : Module name}
        {name : Query name}
        {--f|force : Overwrite existing files}';

    protected $description = 'Create new query with handler';

    public function handle(): int
    {
        try {
            $this->validateModule();
            $name = $this->normalizeName($this->argument('name'));

            $queryPath = $this->generateQuery($name);
            $handlerPath = $this->generateHandler($name);

            $this->info(sprintf(
                "Query [%s] with handler created successfully. \nQuery: [%s]\nHandler: [%s]",
                $name,
                $queryPath,
                $handlerPath,
            ));

            return self::SUCCESS;

        } catch (Throwable $e) {
            $this->error('Error: '.$e->getMessage());

            return self::FAILURE;
        }
    }

    private function generateQuery(string $name): string
    {
        return $this->generateFile(
            'Query',
            "Application/Queries/{$name}.php",
            ['**QueryName**' => $name]
        );
    }

    private function generateHandler(string $name): string
    {
        return $this->generateFile(
            'QueryHandler',
            "Application/Queries/Handlers/{$name}Handler.php",
            ['**QueryName**' => $name]
        );
    }
}
