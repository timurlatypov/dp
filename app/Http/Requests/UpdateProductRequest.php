<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
			'slug' => 'required|max:191',
			'brand_id' => 'required|max:191',
			'title_eng' => 'required|max:191',
			'title_rus' => 'required|max:191',
			'description_short' => 'required',
			'description_full' => 'required',
			'meta_title' => 'required|max:191',
//			'meta_description' => 'required|max:300',
//			'meta_keywords' => 'required|max:255',

		];
	}

	public function messages()
	{
		return [
			'brand_id.required' => 'Поле "Бренд" является обязательным!',
			'title_eng.required' => 'Поле является обязательным!',
			'title_rus.required' => 'Поле является обязательным!',
			'description_short.required' => 'Поле является обязательным!',
			'description_full.required' => 'Поле является обязательным!',
			'meta_title.required' => 'Поле является обязательным!',
//			'meta_description.required' => 'Поле является обязательным!',
//			'meta_keywords.required' => 'Поле является обязательным!',
		];
	}
}
