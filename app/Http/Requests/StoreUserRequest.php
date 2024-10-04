<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }
    


    public function rules(): array 
    {
        return [
            'name' => 'required|string|max:50',
            'email' => 'required|unique:users|email',
            'phone' => 'required|digits_between:0,40',
            'birthday' => 'required',
            'password' => 'required|string',
            're_password' => 'required|same:password',
            'address' => 'required|max:191',
            'description' => 'required|max:191',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập tên',
            'name.max' => 'Độ dài tên đã quá 50 kí tự',
            'name.string' => 'Tên phải là dạng kí tự',

            'email.required' => 'Bạn chưa nhập email.',
            'email.email' => 'Nhập email chưa đúng. Ví dụ: abc@gmail',
            'email.unique' => 'Email đã tồn tại! Hãy nhập lại email',

            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.digits' => 'Vui lòng nhập bằng số điện thoại có độ dài < 40',

            'birthday.required' => 'Bạn chưa nhập sinh nhật',

            'password.required' => 'Bạn chưa nhập mật khẩu.',

            're_password.required' => 'Bạn chưa nhập lại mật khẩu.',
            're_password.same' => 'Nhập lại mật khẩu không khớp.',

            'address.required' => 'Bạn chưa nhập rõ địa chỉ.',
            'address.max' => 'Độ dài phần địa chỉ đã quá 191 kí tự',
            'description.required' => 'Bạn chưa nhập ghi chú.',
            'description.max' => 'Độ dài phần ghi chú đã quá 191 kí tự',
        ];
    }
}
