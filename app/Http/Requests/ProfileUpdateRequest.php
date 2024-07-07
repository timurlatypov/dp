<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:191',
            'surname' => 'required|string|max:191',
            'phone' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле Имя является обязательным!',
            'surname.required' => 'Поле Фамилия является обязательным!',
            'phone.required' => 'Поле Телефон является обязательным!',
        ];
    }
}
