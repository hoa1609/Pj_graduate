<?php

namespace App\Http\Requests\Promotion;

use Illuminate\Foundation\Http\FormRequest;

class StorePromotionRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'code' => 'required|unique:promotions',
            'startDate' => 'required',
            'endDate' => 'required_if:neverEndDate,false|after:startDate',
        ];

        if(!$this->input('neverEndDate')){
            $rules['endDate'] = 'required|after:startDate';
        }
        return $rules;
    }

    public function messages(): array
    {
        $messages = [
            'name.required' => 'Vui lòng nhập tên mã khuyến mại.',
            'code.required' => 'Vui lòng nhập từ khóa của mã khuyến mại.',
            'code.unique' => 'Mã khuyến mại này đã tồn tại. Vui lòng chọn từ khóa khác!',
            'startDate.required' => 'Bạn chưa chọn ngày bắt đầu khuyến mại',
            // 'startDate.custom_date_format' => 'Ngày bắt đàu khuyến mại không đúng định dạng',
            'endDate.required' => 'Bạn chưa chọn ngày kết thúc khuyến mại',
            // 'endDate.custom_date_format' => 'Ngày kết thúc khuyến mại không đúng định dạng',
        ];

        if(!$this->input('neverEndDate')){
            $messages['endDate.required'] = 'Bạn chưa chọn ngày kết thúc của khuyến mại';
            $messages['endDate.after'] = 'Ngày kết thúc khuyến mại phải là một ngày sau ngày bắt đầu khuyến mại';
        }
        return $messages;
    }
}
