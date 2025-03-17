<?php

declare(strict_types=1);

namespace Modules\Exp\Infrastructure\Cli;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use SplFileInfo;
use Symfony\Component\Finder\Finder;
use Throwable;

class CreateListenerCli extends BaseModuleCli
{
    protected $signature = 'make:module:listener
        {module : Module name}
        {name : Listener name}
        {--f|force : Overwrite existing files}';

    protected $description = 'Create new event listener';

    public function handle(): int
    {
        try {
            $this->validateModule();
            $listenerName = $this->normalizeName($this->argument('name'));
            $module = $this->moduleName();
            $events = $this->getAvailableEvents();

            if ($events->isEmpty()) {
                $this->error('No events found in any module');

                return self::FAILURE;
            }

            $eventClass = $this->choice('Select event to listen for', $events->keys()->toArray());
            $path = $this->generateListener($listenerName, $eventClass);

            $this->info("Listener [{$listenerName}] created for event [{$eventClass}] at [{$path}]");

            $this->showRegistrationExample('listener', [
                'ModuleName' => $module,
                'Namespace' => "Modules\\{$module}",
                'EventClass' => $eventClass,
                'ListenerClass' => $listenerName,
            ]);

            return self::SUCCESS;

        } catch (Throwable $e) {
            $this->error('Error: '.$e->getMessage());

            return self::FAILURE;
        }
    }

    private function generateListener(string $listenerName, string $eventClass): string
    {
        return $this->generateFile(
            'Listener',
            "Application/Listeners/{$listenerName}.php",
            [
                '**ListenerName**' => $listenerName,
                '**EventClass**' => $eventClass,
                '**EventName**' => class_basename($eventClass),
            ]
        );
    }

    /** @return Collection<string, non-falsy-string> */
    private function getAvailableEvents(): Collection
    {
        return collect(File::directories('modules'))
            ->flatMap(function (string $modulePath): array {
                $eventPath = "{$modulePath}/Application/Events";
                if (! File::exists($eventPath)) {
                    return [];
                }

                $files = iterator_to_array(
                    (new Finder)
                        ->in($eventPath)
                        ->files()
                        ->name('*.php'),
                    false
                );

                return collect($files)
                    ->map(function (SplFileInfo $file): ?string {
                        return $this->getEventClassName($file);
                    })
                    ->filter()
                    ->values()
                    ->all();
            })
            ->mapWithKeys(function (string $class): array {
                return [$class => $class];
            });
    }

    private function getEventClassName(SplFileInfo $file): ?string
    {
        try {
            $content = File::get($file->getRealPath());
            if (preg_match('/namespace\s+(.+?);.*?class\s+(\w+)/s', $content, $matches)) {
                return "{$matches[1]}\\{$matches[2]}";
            }

            return null;
        } catch (Throwable) {
            return null;
        }
    }
}
