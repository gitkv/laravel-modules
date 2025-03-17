<?php

declare(strict_types=1);

namespace Modules\Exp\Infrastructure\Cli;

use Illuminate\Support\Str;
use Throwable;

class CreateRouteCli extends BaseModuleCli
{
    protected $signature = 'make:module:route
        {module : Module name}
        {--f|force : Overwrite existing files}';

    protected $description = 'Create route file for module';

    public function handle(): int
    {
        try {
            $this->validateModule();
            $type = $this->choice('Select route type', ['web', 'api']);

            $path = $this->generateFile(
                'Routes',
                "Infrastructure/Http/Routes/{$type}.php",
                ['**module_snake**' => Str::snake($this->moduleName())]
            );

            $this->info("{$type} routes created successfully at [{$path}]");

            return self::SUCCESS;

        } catch (Throwable $e) {
            $this->error('Error: '.$e->getMessage());

            return self::FAILURE;
        }
    }
}
