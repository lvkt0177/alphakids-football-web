<?php

namespace App\Http\Requests\Admin\Registration;

use App\Enums\Gender;
use App\Enums\ReferralSource;
use App\Enums\RegistrationStatus;
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
            'birth_year' => ['nullable', 'integer', 'min:2000', 'max:'.date('Y')],
            'gender' => ['nullable', Rule::enum(Gender::class)],
            'phone' => ['required', 'string', 'max:20'],
            'trial_date' => ['nullable', 'date'],
            'status' => ['required', Rule::enum(RegistrationStatus::class)],
            'note' => ['nullable', 'string'],
            'branches' => ['nullable', 'array'],
            'branches.*' => ['exists:branches,id'],
            'referral_sources' => ['nullable', 'array'],
            'referral_sources.*' => [Rule::enum(ReferralSource::class)],
            'referral_school' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'child_name.required' => 'Vui lòng nhập tên bé.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'birth_year.integer' => 'Năm sinh không hợp lệ.',
        ];
    }
}