<?php

declare(strict_types=1);

namespace Modules\Example\Domain\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель для работы с таблицей examples.
 */
class Example extends Model
{
    protected $fillable = ['name', 'description'];
}
