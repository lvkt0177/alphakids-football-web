<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class ImageSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'images.*' => ['nullable', 'image', 'max:6144'],
        ];
    }

    public function messages(): array
    {
        return [
            'images.*.image' => 'File tải lên phải là hình ảnh.',
            'images.*.max' => 'Ảnh không được vượt quá 6MB.',
        ];
    }
}