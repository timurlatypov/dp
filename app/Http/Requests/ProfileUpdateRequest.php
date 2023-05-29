<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
	 * @psalm-return array{'name.required': 'Поле Имя является обязательным!', 'surname.required': 'Поле Фамилия является обязательным!', 'phone.required': 'Поле Телефон является обязательным!'}
	 */
	public function messages()
	{
		return [
			'name.required' => 'Поле Имя является обязательным!',
			'surname.required' => 'Поле Фамилия является обязательным!',
			'phone.required' => 'Поле Телефон является обязательным!'
		];
	}
}
