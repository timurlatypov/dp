<?php

namespace App\Http\Requests\Admin\Discount;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'brand' => 'required|exists:brands,id',
            'discount' => 'required|numeric|min:0|max:99'
        ];
    }

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
