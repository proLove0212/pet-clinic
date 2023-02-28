<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPwdResetRequest extends FormRequest
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
             'password' => 'required',
             'password_confirmdation' => 'required|same:password',
         ];
     }

     public function messages(): array
     {
         return [
            "password" => [
                "required" => "パスワードを入力してください。"
            ],
            "password_confirmdation" => [
                "required" => "パスワードを入力してください。",
                "same" => "パスワードは同じではありません。"
            ]
         ];
     }
}
