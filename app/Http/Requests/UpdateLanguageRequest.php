<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLanguageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'canonical' => 'required|unique:languages,canonical, '.$this->id.'',
            'description' => 'required',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập vào tên ngôn ngữ',
            'canonical.required' => 'Bạn chưa nhập vào từ điển',
            'canonical.unique' => 'Từ khóa đã tồn tại hãy chọn từ khóa khác',

            'description.required' => 'Bạn chưa nhập vào mô tả',
        ];
    }
}
