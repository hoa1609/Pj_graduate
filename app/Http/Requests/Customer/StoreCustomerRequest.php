<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
    public function rules(): array {
        return [
            'name' => 'required|string|max:50',
            'email' => 'required|unique:customers|email',
            'password' => 'required|string',
            'customer_catalogue_id' => 'required|integer|gt:0',
            'source_id' => 'required|integer|gt:0',
            're_password' => 'required|same:password',
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
            'password.required' => 'Bạn chưa nhập mật khẩu.',
            're_password.required' => 'Bạn chưa nhập lại mật khẩu.',
            're_password.same' => 'Nhập lại mật khẩu không khớp.',
            'customer_catalogue_id.gt' => 'Bạn chưa chọn nhóm khách hàng',
            'source_id.gt' => 'Bạn chưa chọn nguồn khách hàng',
        ];
    }
}
