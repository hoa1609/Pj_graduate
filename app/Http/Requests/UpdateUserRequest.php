<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required|string|email|unique:users,email, '.$this->id.'|max:191',
            'name' => 'required|string|max:50',
            'user_catalogue_id' => 'required|integer|gt:0',
        ];
    }


    public function messages(): array
    {
        return [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Nhập email chưa đúng. Ví dụ: abc@gmail',
            'email.unique' => 'Email đã tồn tại. Hãy chọn email khác!',
            'email.max' => 'Độ dài của email tối đa 191 ký tự',
            'name.required' => 'Vui lòng nhập họ tên.',
            'name.string' => 'Họ tên phải là dạng ký tự',
            'name.max' => 'Độ dài của họ tên tối đa 50 ký tự',
            'user_catalogue_id.gt' => 'Bạn chưa chọn nhóm thành viên',
        ];
    }
}
