<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ImageSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'images.*' => ['nullable', 'image', 'max:30720', Rule::dimensions()->maxWidth(8000)->maxHeight(8000)],

            'crop_desktop' => ['nullable', 'array'],
            'crop_desktop.x' => ['required_with:crop_desktop', 'numeric', 'min:0'],
            'crop_desktop.y' => ['required_with:crop_desktop', 'numeric', 'min:0'],
            'crop_desktop.width' => ['required_with:crop_desktop', 'numeric', 'min:1'],
            'crop_desktop.height' => ['required_with:crop_desktop', 'numeric', 'min:1'],

            'crop_mobile' => ['nullable', 'array'],
            'crop_mobile.x' => ['required_with:crop_mobile', 'numeric', 'min:0'],
            'crop_mobile.y' => ['required_with:crop_mobile', 'numeric', 'min:0'],
            'crop_mobile.width' => ['required_with:crop_mobile', 'numeric', 'min:1'],
            'crop_mobile.height' => ['required_with:crop_mobile', 'numeric', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'images.*.image' => 'File tải lên phải là hình ảnh.',
            'images.*.max' => 'Ảnh không được vượt quá 30MB.',
            'images.*.dimensions' => 'Ảnh có độ phân giải quá lớn (tối đa 8000x8000px). Vui lòng dùng ảnh nhỏ hơn.',
        ];
    }
}