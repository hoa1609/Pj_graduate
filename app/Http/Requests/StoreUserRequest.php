<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
<<<<<<< HEAD
    
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'name' => 'required|string|max:50',
            'email' => 'required|unique:users|email',
            'phone' => 'required|digits_between:0,40',
            'birthday' => 'required',
            'password' => 'required|string',
            're_password' => 'required|same:password',
            'address' => 'required|max:191',
            'description' => 'max:191',
=======
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
            'email' => 'required|string|email|unique:users|max:191',
            'name' => 'required|string|max:50',
            'user_catalogue_id' => 'required|integer|gt:0',
            'password' => 'required|string|min:8',
            're_password' => 'same:password',
>>>>>>> syupload
        ];
    }


<<<<<<< HEAD
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
            'birthday.required' => 'Bạn chưa nhập sinh nhật',
            'password.required' => 'Bạn chưa nhập mật khẩu.',
            're_password.required' => 'Bạn chưa nhập lại mật khẩu.',
            're_password.same' => 'Nhập lại mật khẩu không khớp.',
            'address.required' => 'Bạn chưa nhập rõ địa chỉ.',
            'address.max' => 'Độ dài phần địa chỉ đã quá 191 kí tự',
            'description.max' => 'Độ dài phần ghi chú đã quá 191 kí tự',
=======
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
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.max' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            're_password.same' => 'Mật khẩu xác nhận không trùng khớp.',
>>>>>>> syupload
        ];
    }
}
