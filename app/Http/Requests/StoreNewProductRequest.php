<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }

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
     * @return string[]
     *
     * @psalm-return array{'slug.required': 'Поле "Slug" является обязательным и значение должно быть уникальным!', 'brand_id.required': 'Поле "Бренд" является обязательным!', 'title_eng.required': 'Поле является обязательным!', 'title_rus.required': 'Поле является обязательным!', 'description_short.required': 'Поле является обязательным!', 'description_full.required': 'Поле является обязательным!', 'meta_title.required': 'Поле является обязательным!'}
     */
    public function messages()
    {
        return [
            'slug.required' => 'Поле "Slug" является обязательным и значение должно быть уникальным!',
            'brand_id.required' => 'Поле "Бренд" является обязательным!',
            'title_eng.required' => 'Поле является обязательным!',
            'title_rus.required' => 'Поле является обязательным!',
            'description_short.required' => 'Поле является обязательным!',
            'description_full.required' => 'Поле является обязательным!',
            'meta_title.required' => 'Поле является обязательным!',
        ];
    }
}
