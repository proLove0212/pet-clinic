<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_no' => 'required|unique:users,user_no|max:5|min:5|digits:5',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:users,email'
        ];
    }

    public function messages(): array
    {
        return [

        ];
    }
}