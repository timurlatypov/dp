<?php

namespace App\Http\Requests\V2\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductPatchRequest extends FormRequest
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
     * @return string[][]
     *
     * @psalm-return array{slug: list{'required', string}}
     */
    public function rules(): array
    {
        return [
            'slug' => [
                'required',
                'unique:products,slug,'.$this->id
            ],
        ];
    }

    /**
     * @return string[]
     *
     * @psalm-return array{'slug.unique': 'Этот slug уже у другого продукта'}
     */
    public function messages()
    {
        return [
            'slug.unique' => 'Этот slug уже у другого продукта'
        ];
    }
}
