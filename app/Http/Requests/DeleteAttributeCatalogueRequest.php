<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckAttributeCatalogueChildrenRule;

class DeleteAttributeCatalogueRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        $id = $this->route('id');
        return [
            'name' => [
               new CheckAttributeCatalogueChildrenRule($id)
            ],
        ];
    }

}
