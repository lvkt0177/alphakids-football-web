<?php

namespace App\Http\Requests\Admin\Branch;

use App\Enums\ScheduleLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BranchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        // Without this, removing every row leaves no "schedule" key in the request at
        // all, so validated() silently drops it and update() never clears the column.
        $this->merge([
            'schedule' => $this->input('schedule', []),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'image' => ['nullable', 'image', 'max:30720', Rule::dimensions()->maxWidth(8000)->maxHeight(8000)],
            'schedule' => ['nullable', 'array'],
            'schedule.*.day' => ['required', 'string', 'max:50'],
            'schedule.*.start' => ['required', 'date_format:H:i'],
            'schedule.*.end' => ['required', 'date_format:H:i', 'after:schedule.*.start'],
            'schedule.*.level' => ['nullable', Rule::enum(ScheduleLevel::class)],
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
            'location.required' => 'Vui lòng nhập địa điểm cơ sở.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'description.max' => 'Mô tả ngắn không được vượt quá 500 ký tự.',
            'image.image' => 'File tải lên phải là hình ảnh.',
            'image.max' => 'Hình ảnh không được vượt quá 30MB.',
            'image.dimensions' => 'Ảnh có độ phân giải quá lớn (tối đa 8000x8000px). Vui lòng dùng ảnh nhỏ hơn.',
            'schedule.*.day.required' => 'Vui lòng chọn thứ cho mỗi khung giờ.',
            'schedule.*.start.required' => 'Vui lòng nhập giờ bắt đầu.',
            'schedule.*.start.date_format' => 'Giờ bắt đầu không hợp lệ.',
            'schedule.*.end.required' => 'Vui lòng nhập giờ kết thúc.',
            'schedule.*.end.date_format' => 'Giờ kết thúc không hợp lệ.',
            'schedule.*.end.after' => 'Giờ kết thúc phải sau giờ bắt đầu.',
            'sort_order.integer' => 'Thứ tự hiển thị phải là số nguyên.',
            'sort_order.min' => 'Thứ tự hiển thị không được nhỏ hơn 0.',
        ];
    }
}
