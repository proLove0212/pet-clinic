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
            'PeaksUserNo' => 'required|unique:pckusers,PeaksUserNo|digits:6',
            'ClinicName' => 'required|unique:pckusers,ClinicName',
            'TelNo' => 'required',
            'MailAddress' => 'required|unique:pckusers,MailAddress',
            'DBNo' => 'required|digits_between:1,10'
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
