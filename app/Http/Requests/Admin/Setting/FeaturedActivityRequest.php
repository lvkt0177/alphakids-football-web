<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class FeaturedActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'activities' => ['nullable', 'array', 'max:6'],
            'activities.*' => ['exists:activities,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'activities.max' => 'Chỉ được chọn tối đa 6 hoạt động nổi bật.',
        ];
    }
}