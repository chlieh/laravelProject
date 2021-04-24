<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validateProduct extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => 'required|max:255|unique:products',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'veuillez donner un nom au produit',
            'product_name.unique' => 'Le produit doit etre unqiue',
        ];
    }
}
