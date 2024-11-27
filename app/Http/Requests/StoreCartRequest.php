<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequest extends FormRequest
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
            'fullname' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:customers|email',
            'address' => 'required',
            
        ];
    }

    public function messages(): array
    {
        return [
            'fullname.required' => 'Vui lòng nhập tên của bạn.',
            'phone.required' => 'Vui lòng số điện của bạn.',
            'email.required' => 'Bạn chưa nhập email.',
            'email.email' => 'Nhập email chưa đúng. Ví dụ: abc@gmail',
            'email.unique' => 'Email đã tồn tại! Hãy nhập lại email',

            'address.required' => 'Vui lòng nhập địa chỉ cụ thể của bạn.',
            
        ];
    }
}
