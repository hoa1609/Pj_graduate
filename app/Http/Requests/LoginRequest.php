<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
<<<<<<< HEAD

    public function authorize(): bool
    {
        return true;
    }

=======
>>>>>>> syupload
    
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }


    public function messages(): array
    {
        return [
            'email.required' => 'Bạn chưa nhập vào email.',
            'email.email' => 'Nhập email chưa đúng. Ví dụ: abc@gmail',
            'password.required' => 'Bạn chưa nhập vào password.',
        ];
    }
}
