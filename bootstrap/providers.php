<?php

declare(strict_types=1);

use Modules\Common\Infrastructure\Providers\CommonServiceProvider;
use Modules\Common\Infrastructure\Providers\ResponseMacroServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    CommonServiceProvider::class,
    ResponseMacroServiceProvider::class,
    Modules\ModuleServiceProvider::class,
];
