<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPost extends FormRequest
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
            'username' => 'required',
            'password' => 'required|min:3|max:6',
            'email' => 'required',
            'c_name' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Username is Required.',
            'password.required' => 'Password is Required.',
            'password.min' => 'Password Must be beween 3 to 6.',
            'password.max' => 'Password Must be beween 3 to 6.',
            'email.required' => 'Email is Required.',
            'c_name.required' => 'Company Name is Required.'
        ];
    }
    
}
