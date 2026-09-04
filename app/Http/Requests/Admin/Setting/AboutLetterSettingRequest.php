<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class AboutLetterSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'about_letter_name' => ['nullable', 'string', 'max:100'],
            'about_letter_role' => ['nullable', 'string', 'max:150'],
            'about_letter_message' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            '*.max' => 'Không được vượt quá :max ký tự.',
        ];
    }
}
