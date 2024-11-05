<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSlideRequest extends FormRequest
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
            'keyword' => 'required|unique:slides,keyword, '.$this->id.'|max:191',
            'slide.image' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên slide.',
            'keyword.required' => 'Vui lòng nhập từ khóa của slide.',
            'keyword.unique' => 'Từ khóa này đã tồn tại. Vui lòng chọn từ khóa khác!',
            'slide.image.required' => 'Vui lòng chọn hình ảnh cho slide.'
        ];
    }
}
