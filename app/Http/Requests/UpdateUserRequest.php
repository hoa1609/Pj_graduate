<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
<<<<<<< HEAD
   
=======
    /**
     * Determine if the user is authorized to make this request.
     */
>>>>>>> syupload
    public function authorize(): bool
    {
        return true;
    }

<<<<<<< HEAD
    
    public function rules(): array 
    {
        return [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $this->id,

            'phone' => 'required|numeric|digits_between:0,20',
            'birthday' => 'required',
            'address' => 'required|max:191',
            'description' => 'required|max:191',
=======
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
>>>>>>> syupload
        ];
    }


    public function messages(): array
    {
        return [
<<<<<<< HEAD
            'name.required' => 'Bạn chưa nhập tên',
            'name.max' => 'Độ dài tên đã quá 50 kí tự',
            'name.string' => 'Tên phải là dạng kí tự',

            'email.required' => 'Bạn chưa nhập email.',
            'email.email' => 'Nhập email chưa đúng. Ví dụ: abc@gmail',
            'email.unique' => 'Email đã tồn tại! Hãy nhập lại email',

            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại chỉ được chứa các chữ số.',
            'phone.digits_between' => 'Số điện thoại phải có từ :min đến :max chữ số.',

            'birthday.required' => 'Bạn chưa nhập sinh nhật',

            'address.required' => 'Bạn chưa nhập rõ địa chỉ.',
            'address.max' => 'Độ dài phần địa chỉ đã quá 191 kí tự',
            
=======
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Nhập email chưa đúng. Ví dụ: abc@gmail',
            'email.unique' => 'Email đã tồn tại. Hãy chọn email khác!',
            'email.max' => 'Độ dài của email tối đa 191 ký tự',
            'name.required' => 'Vui lòng nhập họ tên.',
            'name.string' => 'Họ tên phải là dạng ký tự',
            'name.max' => 'Độ dài của họ tên tối đa 50 ký tự',
            'user_catalogue_id.gt' => 'Bạn chưa chọn nhóm thành viên',
>>>>>>> syupload
        ];
    }
}
