<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRoleRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array{
        return [
            'name' => 'required|string|max:50',
            'description' => 'required|max:191',

        ];
    }

    public function messages(){
        return [
            'name.required' => 'Bạn chưa nhập tên nhóm thành viên',
            'name.max' => 'Độ dài tên đã quá 50 kí tự',
            'name.string' => 'Tên phải là dạng kí tự',

            'description.required' => 'Bạn chưa nhập ghi chú.',
            'description.max' => 'Độ dài phần ghi chú đã quá 191 kí tự',
        ];
    }
}
