<?php

namespace App\Http\Requests\V2\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return true
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return string[]
     *
     * @psalm-return list{''}
     */
    public function rules(): array
    {
        return [
            ''
        ];
    }
}
