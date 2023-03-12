<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
             'email' => 'required',
             'password' => 'required|min:8',
         ];
     }

     public function messages(): array
     {
         return [
            "email" => [
                "required" => "IDもしくはメールアドレスを入力してください。"
            ],
            "password" => [
                "required" => "パスワードを入力してください。",
                "min" => "パスワードは8文字以上でなければなりません。"
            ]
         ];
     }
}
