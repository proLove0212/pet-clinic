<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPwdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

     public function rules(): array
     {
         return [
            'email' => 'required|exists:pckusers,email'
         ];
     }

     public function messages(): array
     {
         return [
             "email" => [
                 "required" => "メールを入力してください。",
                 "exists" => "存在しないメールです。",
             ],

         ];
     }
}
