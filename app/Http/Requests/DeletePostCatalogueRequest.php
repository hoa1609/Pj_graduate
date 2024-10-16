<?php

namespace App\Http\Requests;

use App\Models\PostCatalogue;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckPostCatalogueChildrenRule;

class DeletePostCatalogueRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route("id"); 
        return [
            'name' => [ 
                new CheckPostCatalogueChildrenRule($id)
            ]
        ];
    }


}
