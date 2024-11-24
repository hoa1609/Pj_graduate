<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TranslateRequest extends FormRequest
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
            'translate_name' => 'required',
            'translate_canonical' => 'required|unique:routers,canonical, '.$this->id.',module_id',
            // 'translate_description' => 'required',
        ];
    }


    public function messages(): array
    {
        return [
            'translate_name.required' => 'Bạn chưa nhập vào tên ngôn ngữ',
            'translate_canonical.required' => 'Bạn chưa nhập vào từ điển',
            // 'translate_description.required' => 'Bạn chưa nhập vào mô tả',
        ];
    }
}
