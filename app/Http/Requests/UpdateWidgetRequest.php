<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWidgetRequest extends FormRequest
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
            'keyword' => 'required|unique:widgets,keyword,'.$this->id.'',
            'short_code' => 'required|unique:widgets,short_code,'.$this->id.'',
            'album' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên widget.',
            'keyword.required' => 'Vui lòng nhập từ khóa của widget.',
            'keyword.unique' => 'Từ khóa này đã tồn tại. Vui lòng chọn từ khóa khác!',
            'short_code.required' => 'Vui lòng nhập short_code.',
            'short_code.unique' => 'short_code đã tồn tại vui lòng chọn code khác',
            'album.required' => 'Vui lòng chọn album.',
        ];
    }
}
