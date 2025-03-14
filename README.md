# Демонстрационный модульный проект Laravel

Этот проект демонстрирует модульную архитектуру в Laravel 12 (PHP 8.4). Вместо стандартной папки `app/` все компоненты организованы в виде независимых модулей, расположенных в директории `modules/`. В качестве примера представлен модуль `Example`, предоставляющий web, API и CLI интерфейсы.

## Основные возможности

- **Модульность:** Каждый модуль автономен и содержит собственные контроллеры, модели, сервисы и маршруты.
- **Bus-системы:** Реализованы шины для команд, запросов и событий с поддержкой middleware для логирования, транзакций и кэширования.
- **Гибкая архитектура:** Применяются паттерны CQRS, DDD и Repository для упрощения масштабирования и тестирования.
- **Простота расширения:** Добавление нового модуля сводится к созданию новой директории в `modules/` и реализации интерфейса `ModuleInterface`.

## Сторонние зависимости

Проект использует следующие сторонние пакеты:
- **spatie/laravel-data** Применяется для реализации DTO

Проект устанавливается стандартно используя `sail`:
```bash
./vendor/bin/sail up -d
```

```bash
./vendor/bin/sail composer install
```

## Структура проекта

- **modules/** – все модули проекта.
    - **Common** – ядро системы с общими сервисами, Bus-системами и абстракциями.
    - **Example** – демонстрационный модуль с web, API и CLI интерфейсами.

Каждый модуль имеет собственную структуру, разделённую на:
- **Application** – логика команд, запросов, событий и бизнес-сервисов.
- **Domain** – модели, репозитории и доменные сущности.
- **Infrastructure** – реализация HTTP-контроллеров, маршрутов, консольных команд и провайдеров.

## Bus-системы и Middleware

Проект использует следующие шины:
- **Command Bus:** Обрабатывает команды. Поддерживает middleware для логирования и транзакций.
```php
// Отправка команды
$commandBus = app(CommandBusInterface::class);

$commandBus->dispatch(new CreateExampleItem($name, $desc));
```
- **Query Bus:** Обрабатывает запросы с middleware для логирования и кэширования.
```php
// Запрос данных
$queryBus = app(QueryBusInterface::class);

$items = $queryBus->ask(new GetAllExampleWithPaginate());

```
- **Event Bus:** Публикует события и уведомляет подписчиков, тоже имеет middleware для логирования.
```php
// Публикация события
ExampleCreated::dispatch($item);
```

> **Важно:** Внутри модулей реализация может быть произвольной, но взаимодействие между модулями должно осуществляться строго через шины. Это правило продемонстрировано на примере модуля `Example`.

## Создание нового модуля

1. **Создание директории:**  
   Создайте новую папку в `modules/`, например, `YourModule`. И поддиректории: `Application`,`Domain`,`Infrastructure`
```bash
mkdir -p modules/YourModule/{Application,Domain,Infrastructure}
```

2. **Реализация интерфейса:**  
   Создайте главный класс модуля в корне модуля `YourModule.php`, унаследовавшись от `BaseModule`.
```php
// modules/YourModule/YourModule.php
<?php

declare(strict_types=1);

namespace Modules\YourModule;

use Modules\BaseModule;
use Override;

class YourModule extends BaseModule
{
    protected static string $modulePath = __DIR__;

    #[Override]
    public function name(): string
    {
        return 'YourModule';
    }

    #[Override]
    public function getCommands(): array
    {
        return [];
    }

    #[Override]
    protected function getProviders(): array
    {
        return [YourModuleServiceProvider::class];
    }
}
```

4. **Регистрация:**  
   Добавьте главный класс модуля `YourModule.php` в `ModuleServiceProvider` в свойство `$modules`. Если необходимо отключить модуль, достаточно убрать его запись из этого массива.
```php
// modules/ModuleServiceProvider.php
private array $modules = [
    CommonModule::class,
    YourModule::class,
];
```

## Рекомендуемая структура:
```text
modules/YourModule/
├── Application/                   # Слой бизнес-логики
│   ├── Commands/                  # Command (CQRS) – операции, изменяющие состояние
│   │   └── CreateYourEntity.php
│   ├── DTO/                       # Data Transfer Objects (DTO) – для передачи данных
│   │   └── YourEntityData.php
│   ├── Events/                    # Доменные события
│   │   └── YourEntityCreated.php
│   ├── Listeners/                 # Слушатели событий
│   │   └── LogYourEntityCreated.php
│   ├── Query/                     # Query (CQRS) – получение данных
│   │   ├── GetYourEntityById.php
│   │   └── Handlers/              # Обработчики запросов
│   │       └── GetYourEntityByIdHandler.php
│   └── Services/                  # Бизнес-сервисы для реализации логики
│       └── YourEntityService.php  # Сервис для работы с YourEntity
│
├── Domain/                        # Доменный слой
│   ├── Models/                    # Доменные модели (сущности)
│   │   └── YourEntity.php         # Модель сущности YourEntity
│   └── Repositories/              # Интерфейсы репозиториев для работы с данными
│       └── YourEntityRepositoryInterface.php  # Интерфейс репозитория для YourEntity
│
├── Infrastructure/                # Слой инфраструктуры
│   ├── Cli/                       # Консольные команды для управления модулем
│   │   └── YourEntityCommand.php  # Пример CLI-команды для YourModule
│   ├── Http/                      # Web-интерфейс модуля
│   │   ├── Controllers/           # Контроллеры для обработки HTTP-запросов
│   │   │   └── YourEntityController.php
│   │   ├── Requests/              # HTTP-запросы и валидация входных данных
│   │   │   └── CreateYourEntityRequest.php
│   │   ├── Routes/
│   │   │   ├── web.php            # Маршруты для web-интерфейса
│   │   │   └── api.php            # Маршруты для API-интерфейса
│   │   └── Resources/             # Ресурсы для форматирования данных (например, API-ресурсы)
│   │       └── YourEntityResource.php
│   └── Providers/                 # Сервис-провайдеры для регистрации зависимостей и конфигураций модуля
│       └── YourModuleServiceProvider.php
│
└── YourModule.php                 # Главный класс модуля, реализующий ModuleInterface

```
