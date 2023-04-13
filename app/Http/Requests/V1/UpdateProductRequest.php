<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $method = $this->method();
        
        if($method == 'PUT'){
            return [
                'name' => ['required', 'max:255'],
                'description' => ['required'],
                'price' => ['required', 'numeric', 'decimal:0,2']
            ];
        }else{
            return [
                'name' => ['sometimes','required', 'max:255'],
                'description' => ['sometimes','required'],
                'price' => ['sometimes','required', 'numeric', 'decimal:0,2']
            ];
        }
        
    }
}
