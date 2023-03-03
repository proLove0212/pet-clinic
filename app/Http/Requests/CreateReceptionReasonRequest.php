<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReceptionReasonRequest extends FormRequest
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
            'reason_name' => 'required',
            'reason_time' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            "reason_name" => [
                "required" => "訪問理由を入力する必要があります。",
            ],
            "reason_time" => [
                "required" => "消費時間を入力する必要があります。",
            ],

        ];
    }
}
