<?php

declare(strict_types=1);

namespace Modules\Exp\Infrastructure\Cli;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Modules\Exp\Application\Services\ModuleManager;
use Modules\Exp\Application\Services\TemplateGenerator;
use RuntimeException;

abstract class BaseModuleCli extends Command
{
    protected ModuleManager $moduleManager;

    protected TemplateGenerator $templateGenerator;

    public function __construct()
    {
        parent::__construct();
        $this->moduleManager = app(ModuleManager::class);
        $this->templateGenerator = app(TemplateGenerator::class);
    }

    protected function moduleName(): string
    {
        return $this->normalizeName($this->argument('module'));
    }

    protected function normalizeName(string $name): string
    {
        if (! preg_match('/^[a-zA-Z_]+$/', $name)) {
            throw new InvalidArgumentException("Invalid name: {$name}");
        }

        return Str::studly(trim($name));
    }

    protected function validateModule(): void
    {
        $name = $this->moduleName();

        if (! $this->moduleManager->exists($name)) {
            $this->error("Module [{$name}] not found. Available modules:");
            $this->table(['Existing Modules'], collect($this->moduleManager->list())->map(fn ($m) => [$m]));
            throw new RuntimeException('Module validation failed');
        }
    }

    /**
     * @param  array<string, string>  $replacements
     *
     * @throws FileNotFoundException
     */
    protected function generateFile(
        string $stubName,
        string $targetPath,
        array $replacements = [],
        bool $force = false
    ): string {
        $fullPath = $this->moduleManager->getPath($this->moduleName()).'/'.$targetPath;

        if (! $this->confirmGeneration($fullPath)) {
            throw new RuntimeException('File generation cancelled');
        }

        return $this->templateGenerator->generate(
            $this->stubPath($stubName),
            $fullPath,
            $this->prepareReplacements($replacements),
            true
        );
    }

    /**
     * @param  array<string, string>  $custom
     * @return array<string, string>
     */
    protected function prepareReplacements(array $custom): array
    {
        return array_merge([
            '**ModuleName**' => $this->moduleName(),
            '**module_snake**' => Str::snake($this->moduleName()),
        ], $custom);
    }

    private function stubPath(string $name): string
    {
        $path = __DIR__."/stubs/{$name}.stub";

        if (! file_exists($path)) {
            throw new RuntimeException("Stub template [{$name}] not found");
        }

        return $path;
    }

    protected function confirmGeneration(string $path): bool
    {
        if ($this->option('force') || ! file_exists($path)) {
            return true;
        }

        return $this->confirm("File [{$path}] exists. Overwrite?", false);
    }

    /** @param  array<string, string>  $replacements */
    protected function showRegistrationExample(string $type, array $replacements): void
    {
        $stubPath = __DIR__."/stubs/examples/registration-{$type}.stub";

        if (! File::exists($stubPath)) {
            $this->warn('Registration example not found');

            return;
        }

        $content = file_get_contents($stubPath);

        foreach ($replacements as $key => $value) {
            $content = str_replace("**{$key}**", $value, $content);
        }

        $this->warn("🚨 Required registration!\n");
        $this->info("Example registration:\n");
        $this->line(trim($content));
        $this->newLine();
    }
}
