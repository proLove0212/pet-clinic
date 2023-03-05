<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewMaintainRequest extends FormRequest
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
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ];
    }

    public function messages(): array
    {
        return [
            "start_time" => [
                "required" => "開始時間を入力する必要があります。",
                "date" => "形式が無効です。"
            ],
            "end_time" => [
                "required" => "終了時間を入力する必要があります。",
                "date" => "形式が無効です。",
                "after" => "終了時間が無効です。"
            ]
        ];
    }
}
