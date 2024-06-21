<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UpdateBookRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'contact_number' => [
                'required',
                'digits:11',            
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'contact_number.required' => 'Contact number is required',
            'contact_number.digits' => 'Contact number must be 11 digits',
        ];
    }
}
