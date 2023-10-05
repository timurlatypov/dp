<?php

namespace App\Http\Requests\V2\Orders;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderStoreRequest extends FormRequest
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
     * @return (\Illuminate\Validation\Rules\Exists|string)[][]
     *
     * @psalm-return array{address_id: list{'required', \Illuminate\Validation\Rules\Exists}, shipping_method_id: list{'required', 'exists:shipping_methods,id'}}
     */
    public function rules(): array
    {
        return [
            'address_id' => [
                'required',
                Rule::exists('addresses', 'id')->where(function ($builder) {
                    $builder->where('user_id', $this->user()->id);
                })
            ],
            'shipping_method_id' => [
                'required',
                'exists:shipping_methods,id'
            ]
        ];
    }
}
