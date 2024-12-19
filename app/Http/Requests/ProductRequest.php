<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules(): array
    {
        return [
            'name' => 'required',
            'price' => 'required',
            'code' => 'required',
            'canonical' => 'required|unique:routers',
            'product_catalogue_id' => 'gt:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập vào ô tiêu đề.',
            'price.required' => 'Bạn chưa nhập vào ô giá tiền.',
            'code.required' => 'Bạn chưa nhập vào ô mã sản phẩm.',
            'canonical.required' => 'Bạn chưa nhập vào ô đường dẫn',
            'canonical.unique' => 'Đường dẫn đã tồn tại, Hãy chọn đường dẫn khác',
            'product_catalogue_id.gt' => 'Bạn phải nhập danh mục cha',
        ];
    }
}
