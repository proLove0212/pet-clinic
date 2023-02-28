<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
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
             'receivers' => 'required|array',
             'subject' => 'required',
             'content' => 'required',
         ];
     }

     public function messages(): array
     {
         return [
             "receivers" => [
                 "required" => "受信者を選択する必要があります。",
             ],
             "subject" => [
                 "required" => "件名を入力してください。",
             ],
             "content" => [
                 "required" => "内容を入力してください。",
             ],

         ];
     }
}
