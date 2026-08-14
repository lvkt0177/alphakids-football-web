<?php

namespace App\Http\Requests\Admin\Faq;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'question' => ['required', 'string', 'max:500'],
            'answer' => ['required', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
            'show_on_home' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'question.required' => 'Vui lòng nhập câu hỏi.',
            'answer.required' => 'Vui lòng nhập câu trả lời.',
        ];
    }
}
