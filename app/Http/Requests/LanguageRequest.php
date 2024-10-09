<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'name' => 'required',
            'canonical' => 'required',
            'description' => 'required',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập vào tên ngôn ngữ',
            'canonical.required' => 'Bạn chưa nhập vào từ điển',
            'description.required' => 'Bạn chưa nhập vào mô tả',
        ];
    }
}
