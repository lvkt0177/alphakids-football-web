<?php

namespace App\Http\Requests\Client;

use App\Enums\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'birth_year' => ['required', 'integer', 'min:2000', 'max:'.date('Y')],
            'gender' => ['required', Rule::enum(Gender::class)],
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
            'birth_year.required' => 'Vui lòng chọn năm sinh.',
            'gender.required' => 'Vui lòng chọn giới tính.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'branches.required' => 'Vui lòng chọn cơ sở đăng ký.',
        ];
    }
}
