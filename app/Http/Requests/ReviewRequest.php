<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            // 'rating' => 'required|integer|min:1|max:5',
            'fullname' => 'required|string|min:2|max:100',
            'email' => 'required|email',
            'phone' => 'required',
            'description' => 'required|string|min:10|max:191',
        ];
    }

    public function messages()
    {
        return [
            // 'rating.required' => 'Vui lòng chọn số sao đánh giá',
            // 'rating.integer' => 'Đánh giá không hợp lệ',
            // 'rating.min' => 'Đánh giá không hợp lệ',
            // 'rating.max' => 'Đánh giá không hợp lệ',

            'fullname.required' => 'Vui lòng nhập họ tên',
            'fullname.min' => 'Họ tên phải có ít nhất :min ký tự',

            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',

            'phone.required' => 'Vui lòng nhập số điện thoại',

            'description.required' => 'Vui lòng nhập nội dung đánh giá',
            'description.min' => 'Nội dung đánh giá phải có ít nhất :min ký tự',
            'description.max' => 'Nội dung đánh giá quá dài',
        ];
    }
}
