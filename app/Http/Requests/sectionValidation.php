<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class sectionValidation extends FormRequest
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
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return
            [
                'section_name.required' => 'Vous devez tapez le nom de la section',
                'section_name.unique' => 'cette section est déja existe',

            ];
    }
}
