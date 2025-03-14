<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class IdeHelperServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole() && $this->app->environment('local')) {
            $this->app['config']->set('ide-helper.model_locations', array_merge(
                config('ide-helper.model_locations', []),
                $this->getModuleModelPaths()
            ));
        }
    }

    /** @return array<string> */
    protected function getModuleModelPaths(): array
    {
        $modulesPath = base_path('modules');
        $paths = [];

        foreach (File::directories($modulesPath) as $moduleDir) {
            $modelDir = $moduleDir.'/Domain/Models';
            if (File::exists($modelDir)) {
                $paths[] = $modelDir;
            }
        }

        return $paths;
    }
}
