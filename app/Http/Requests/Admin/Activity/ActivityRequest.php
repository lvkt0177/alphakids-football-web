<?php

namespace App\Http\Requests\Admin\Activity;

use App\Enums\ActivityCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::enum(ActivityCategory::class)],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:30720', Rule::dimensions()->maxWidth(8000)->maxHeight(8000)],
            'is_featured' => ['boolean'],
            'featured_order' => ['nullable', 'integer', 'min:0'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên hoạt động.',
            'category.required' => 'Vui lòng chọn danh mục.',
            'image.image' => 'File tải lên phải là hình ảnh.',
            'image.max' => 'Hình ảnh không được vượt quá 30MB.',
            'image.dimensions' => 'Ảnh có độ phân giải quá lớn (tối đa 8000x8000px). Vui lòng dùng ảnh nhỏ hơn.',
        ];
    }
}
