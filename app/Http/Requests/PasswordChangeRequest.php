<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordChangeRequest extends FormRequest
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
            'old_password' => 'required',
            'password' => 'required|min:8',
            'password_confirmdation' => 'required|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            "old_password" => [
                "required" => "パスワードを入力してください。",
            ],
            "password" => [
                "required" => "パスワードを入力してください。",
                "min" => "パスワードはアルファベット(大文字小文字)、数字、記号(!#$%&[]+-/*\?)を使い8文字以上で設定してください"
            ],
            "password_confirmdation" => [
                "required" => "パスワードを入力してください。",
                "same" => "パスワードは同じではありません。"
            ]
        ];
    }
}