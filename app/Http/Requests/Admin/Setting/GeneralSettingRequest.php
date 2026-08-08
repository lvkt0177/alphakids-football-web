<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class GeneralSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hotline' => ['required', 'string', 'max:20'],
            'zalo_contact' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'consulting_hours' => ['nullable', 'string', 'max:255'],
            'facebook_url' => ['nullable', 'url'],
            'tiktok_url' => ['nullable', 'url'],
            'zalo_url' => ['nullable', 'url'],
        ];
    }

    public function messages(): array
    {
        return [
            'hotline.required' => 'Vui lòng nhập Hotline.',
            'email.email' => 'Email không đúng định dạng.',
            'facebook_url.url' => 'Link Facebook không hợp lệ.',
            'tiktok_url.url' => 'Link TikTok không hợp lệ.',
            'zalo_url.url' => 'Link Zalo không hợp lệ.',
        ];
    }
}