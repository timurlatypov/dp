<?php

namespace App\Http\Requests\Admin\Discount;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountRequest extends FormRequest
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
     * @return string[]
     *
     * @psalm-return array{'brand.required': 'Обязательно выбрать бренд', 'brand.exists': 'Выберите бренд из списка', 'discount.required': 'Необходимо ввести скидку', 'discount.numeric': 'Необходимо ввести числовое значение', 'discount.min': 'Минимальное значение 0', 'discount.max': 'Максимальное значение 99'}
     */
    public function messages()
    {
        return [
            'brand.required' => 'Обязательно выбрать бренд',
            'brand.exists' => 'Выберите бренд из списка',
            'discount.required' => 'Необходимо ввести скидку',
            'discount.numeric' => 'Необходимо ввести числовое значение',
            'discount.min' => 'Минимальное значение 0',
            'discount.max' => 'Максимальное значение 99',

        ];
    }
}
