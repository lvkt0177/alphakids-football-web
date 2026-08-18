<?php

namespace App\Http\Requests\Admin\ProofPoint;

use Illuminate\Foundation\Http\FormRequest;

class ProofPointRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => ['required', 'string'],
            'author_name' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'Vui lòng nhập nội dung trích dẫn.',
            'author_name.required' => 'Vui lòng nhập tên phụ huynh.',
        ];
    }
}
