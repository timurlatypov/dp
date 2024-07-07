<?php

namespace App\Http\Requests\V2\Images;

use Illuminate\Foundation\Http\FormRequest;

class ImageStoreRequest extends FormRequest
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
     * @return string[][]
     *
     * @psalm-return array{file: list{'required', 'file', 'image:jpeg,png'}}
     */
    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                'image:jpeg,png',
            ],
        ];
    }
}
