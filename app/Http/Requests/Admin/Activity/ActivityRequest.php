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
        $activityId = $this->route('activity')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('activities', 'slug')->ignore($activityId)],
            'category' => ['required', Rule::enum(ActivityCategory::class)],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:7168'],
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
            'slug.required' => 'Vui lòng nhập slug.',
            'slug.unique' => 'Slug này đã tồn tại.',
            'category.required' => 'Vui lòng chọn danh mục.',
            'image.image' => 'File tải lên phải là hình ảnh.',
            'image.max' => 'Hình ảnh không được vượt quá 7MB.',
        ];
    }
}
