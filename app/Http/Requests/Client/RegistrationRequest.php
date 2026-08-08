<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'child_name' => ['required', 'string', 'max:255'],
            'birth_year' => ['nullable', 'integer', 'min:2000', 'max:'.date('Y')],
            'phone' => ['required', 'string', 'max:20'],
            'branches' => ['required', 'array', 'min:1'],
            'branches.*' => ['exists:branches,id'],
            'note' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'child_name.required' => 'Vui lòng nhập tên bé.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'branches.required' => 'Vui lòng chọn cơ sở đăng ký.',
        ];
    }
}
