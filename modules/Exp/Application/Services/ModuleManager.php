<?php

declare(strict_types=1);

namespace Modules\Exp\Application\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ModuleManager
{
    private const string CACHE_KEY = 'modules:list';

    public function __construct(
        private ?string $modulesPath = null
    ) {
        $this->modulesPath = $modulesPath ?? config('modules.path', 'modules');
    }

    public function getPath(string $name): string
    {
        return $this->modulesPath.'/'.$this->normalizeName($name);
    }

    public function exists(string $name): bool
    {
        return File::isDirectory($this->getPath($name));
    }

    /** @return string[] */
    public function list(): array
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return collect(File::directories($this->modulesPath))
                ->map(fn ($path) => basename($path))
                ->toArray();
        });
    }

    public function normalizeName(string $name): string
    {
        return Str::studly(trim($name));
    }

    public function flushCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
