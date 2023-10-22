<?php

namespace App\Http\Requests\Account\Review;

use Illuminate\Foundation\Http\FormRequest;

class DeleteReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Поле Оценка является обязательным',
        ];
    }
}
