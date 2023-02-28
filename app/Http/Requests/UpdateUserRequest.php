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
            'PeaksUserNo' => 'required|digits:6|unique:pckusers,PeaksUserNo,'.$this->id,
            'ClinicName' => 'required|unique:pckusers,ClinicName,'.$this->id,
            'TelNo' => 'required',
            'MailAddress' => 'required|unique:pckusers,MailAddress,'.$this->id."|email"
        ];
    }

    public function messages(): array
    {
        return [
            "PeaksUserNo" => [
                "required" => "ユーザー番号を入力する必要があります。",
                "digits" => "6桁の数字でなければなりません。",
                "unique" => "すでに存在します。"
            ],
            "ClinicName" => [
                "required" => "病院名を入力する必要があります。",
                "unique" => "すでに存在します。"
            ],
            "TelNo" => [
                "required" => "電話番号を入力する必要があります。",
            ],
            "MailAddress" => [
                "required" => "メールを入力する必要があります。",
                "unique" => "すでに存在します。",
                "email" => "メールが間違っています。"
            ],

        ];
    }
}
