<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLanguageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'canonical' => 'required|unique:languages,canonical, '.$this->id.'',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập vào tên ngôn ngữ.',
            'canonical.requered' => 'Vui lòng nhập vào tên viết tắt của ngôn ngữ.',
            'canonical.unique' => 'Tên viết tắt của ngôn ngữ đã tồn tại.'
        ];
    }
}
