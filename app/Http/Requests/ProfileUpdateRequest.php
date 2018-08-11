<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
			'name' => 'required|string|max:191',
			'surname' => 'required|string|max:191',
			'phone' => 'required'
		];
	}

	public function messages()
	{
		return [
			'name.required' => 'Поле Имя является обязательным!',
			'surname.required' => 'Поле Фамилия является обязательным!',
			'phone.required' => 'Поле Телефон является обязательным!'
		];
	}
}
