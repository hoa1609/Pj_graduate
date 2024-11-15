<?php

namespace App\Http\Requests\Promotion;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Promotion\OrderAmountRangeRule;
use App\Rules\Promotion\ProductAndQuantityRule;
use App\Enums\PromotionEnum;

class UpdatePromotionRequest extends FormRequest
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
            'code' => 'required|unique:promotions,id, '.$this->id.'',
            'startDate' => 'required',
            'endDate' => 'required_if:neverEndDate,false|after:startDate',
        ];

        if(!$this->input('neverEndDate')){
            $rules['endDate'] = 'required|after:startDate';
        }

        $method = $this->input('method');
        switch ($method) {
            case PromotionEnum::ORDER_AMOUNT_RANGE:
                $rules['method'] = [new OrderAmountRangeRule($this->input('promotion_order_amount_range'))];
                break;
            case PromotionEnum::PRODUCT_AND_QUANTITY:
                $rules['method'] = [new ProductAndQuantityRule($this->only('product_and_quantity', 'object'))];
                break;
            default:
                $rules['method'] = 'required|not_in:none';
                break;
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
        $method = $this->input('method');
        if($method === 'none'){
                $messages['method.not_in'] = 'Bạn chưa chọn hình thức khuyến mại';
        }

        if(!$this->input('neverEndDate')){
            $messages['endDate.required'] = 'Bạn chưa chọn ngày kết thúc của khuyến mại';
            $messages['endDate.after'] = 'Ngày kết thúc khuyến mại phải là một ngày sau ngày bắt đầu khuyến mại';
        }
        return $messages;
    }
}
