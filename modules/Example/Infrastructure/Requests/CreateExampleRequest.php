<?php

declare(strict_types=1);

namespace Modules\Example\Infrastructure\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateExampleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ];
    }
}
