<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'user_no' => 'required|digits:6|unique:users,user_no,'.$this->id,
            'name' => 'required|unique:users,clinic_name,'.$this->id,
            'phone' => 'required',
            'email' => 'required|unique:users,email,'.$this->id
        ];
    }

    public function messages(): array
    {
        return [

        ];
    }
}
