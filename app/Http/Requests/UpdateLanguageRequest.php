<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLanguageRequest extends FormRequest
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
    
=======
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
>>>>>>> syupload
    public function rules(): array
    {
        return [
            'name' => 'required',
            'canonical' => 'required|unique:languages,canonical, '.$this->id.'',
<<<<<<< HEAD
            'description' => 'required',
=======
>>>>>>> syupload
        ];
    }


    public function messages(): array
    {
        return [
<<<<<<< HEAD
            'name.required' => 'Bạn chưa nhập vào tên ngôn ngữ',
            'canonical.required' => 'Bạn chưa nhập vào từ điển',
            'canonical.unique' => 'Từ khóa đã tồn tại hãy chọn từ khóa khác',
            
            'description.required' => 'Bạn chưa nhập vào mô tả',
=======
            'name.required' => 'Vui lòng nhập vào tên ngôn ngữ.',
            'canonical.requered' => 'Vui lòng nhập vào tên viết tắt của ngôn ngữ.',
            'canonical.unique' => 'Tên viết tắt của ngôn ngữ đã tồn tại.'
>>>>>>> syupload
        ];
    }
}
