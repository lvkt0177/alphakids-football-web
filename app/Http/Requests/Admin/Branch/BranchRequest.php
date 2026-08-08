<?php

namespace App\Http\Requests\Admin\Branch;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BranchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $branchId = $this->route('branch')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('branches', 'slug')->ignore($branchId)],
            'address' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'features' => ['nullable', 'array', 'max:4'],
            'features.*' => ['string', 'max:255'],
            'schedule_weekday' => ['nullable', 'string', 'max:255'],
            'schedule_weekend' => ['nullable', 'string', 'max:255'],
            'map_embed_url' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên cơ sở.',
            'name.max' => 'Tên cơ sở không được vượt quá 255 ký tự.',
            'slug.required' => 'Vui lòng nhập slug.',
            'slug.unique' => 'Slug này đã tồn tại, vui lòng chọn giá trị khác.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'image.image' => 'File tải lên phải là hình ảnh.',
            'image.max' => 'Hình ảnh không được vượt quá 2MB.',
            'features.max' => 'Chỉ được nhập tối đa 4 đặc điểm.',
            'features.*.max' => 'Mỗi đặc điểm không được vượt quá 255 ký tự.',
            'schedule_weekday.max' => 'Lịch học ngày thường không được vượt quá 255 ký tự.',
            'schedule_weekend.max' => 'Lịch học cuối tuần không được vượt quá 255 ký tự.',
            'sort_order.integer' => 'Thứ tự hiển thị phải là số nguyên.',
            'sort_order.min' => 'Thứ tự hiển thị không được nhỏ hơn 0.',
        ];
    }
}
