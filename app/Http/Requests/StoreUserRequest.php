<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'name' => 'required|string|max:50',
            'email' => 'required|unique:users|email',
            'phone' => 'required|digits_between:0,40',
            'user_role_id' => 'required|integer|min:1',
            'password' => 'required|string',
            're_password' => 'required|same:password',
            'address' => 'max:191',
            'description' => 'max:191',
        ];
    }


    public function messages(): array{
        return [
            'name.required' => 'Bạn chưa nhập tên',
            'name.max' => 'Độ dài tên đã quá 50 kí tự',
            'name.string' => 'Tên phải là dạng kí tự',
            'email.required' => 'Bạn chưa nhập email.',
            'email.email' => 'Nhập email chưa đúng. Ví dụ: abc@gmail',
            'email.unique' => 'Email đã tồn tại! Hãy nhập lại email',
            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.digits' => 'Vui lòng nhập bằng số điện thoại có độ dài < 40',
            'user_role_id.min' => 'Vui lòng chọn tư cách hợp lệ.',
            'password.required' => 'Bạn chưa nhập mật khẩu.',
            're_password.required' => 'Bạn chưa nhập lại mật khẩu.',
            're_password.same' => 'Nhập lại mật khẩu không khớp.',
            'address.max' => 'Độ dài phần địa chỉ đã quá 191 kí tự',
            'description.max' => 'Độ dài phần ghi chú đã quá 191 kí tự',
        ];
    }
}
