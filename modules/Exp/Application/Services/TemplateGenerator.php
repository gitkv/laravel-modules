<?php

declare(strict_types=1);

namespace Modules\Exp\Application\Services;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RuntimeException;

class TemplateGenerator
{
    /**
     * @param  array<string, string>  $replacements
     *
     * @throws FileNotFoundException
     */
    public function generate(
        string $stubPath,
        string $targetPath,
        array $replacements,
        bool $force = false
    ): string {
        $this->validateStub($stubPath);

        if (! $force && File::exists($targetPath)) {
            throw new RuntimeException("File [{$targetPath}] already exists");
        }

        $content = Str::replace(
            array_keys($replacements),
            array_values($replacements),
            File::get($stubPath)
        );

        File::ensureDirectoryExists(dirname($targetPath));
        File::put($targetPath, $content);

        return $targetPath;
    }

    private function validateStub(string $path): void
    {
        if (! File::exists($path)) {
            throw new RuntimeException("Stub template [{$path}] not found");
        }
    }
}
