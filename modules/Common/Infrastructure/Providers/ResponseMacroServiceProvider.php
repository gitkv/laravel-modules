<?php
declare(strict_types=1);

namespace Modules\Common\Infrastructure\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Response::macro('success', function ($data = null, int $code = 200) {
            return response()->json(['data' => $data], $code);
        });

        Response::macro('error', function (string $message, int $code = 400) {
            return response()->json([
                'error' => $message,
                'code' => $code
            ], $code);
        });
    }
}
