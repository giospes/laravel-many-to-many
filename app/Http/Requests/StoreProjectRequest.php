<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
        return [
            'name'=> 'required|max:255',
            'description' =>'required|min:100',
            'type_id' => 'nullable|exists:types,id'
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'The project name is required.',
            'description.required' => 'The project description is required.', 
            'name.max' =>'The project name is too long, max: 255 chars',
            'description.min' =>'The project description is too short, min: 100 char'
        ];
    }
}
