<?php

namespace App\Http\Requests\Account\Review;

use Illuminate\Foundation\Http\FormRequest;

class CreateReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'stars' => 'required',
            'comment' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'stars.required' => 'Поле Оценка является обязательным',
            'comment.required' => 'Поле Отзыв является обязательным',
        ];
    }
}
