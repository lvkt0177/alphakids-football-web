<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VideoSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'video_mode' => ['required', Rule::in(['youtube', 'upload'])],
            'video_youtube_url' => ['nullable', 'url'],
            'video_file' => ['nullable', 'file', 'mimetypes:video/mp4', 'max:307200'],
            'video_thumbnail' => ['nullable', 'image', 'max:30720', Rule::dimensions()->maxWidth(8000)->maxHeight(8000)],
        ];
    }

    public function messages(): array
    {
        return [
            'video_youtube_url.url' => 'Link YouTube không hợp lệ.',
            'video_file.mimetypes' => 'File video phải là định dạng MP4.',
            'video_file.max' => 'File video không được vượt quá 300MB.',
            'video_thumbnail.image' => 'Thumbnail phải là file ảnh.',
            'video_thumbnail.max' => 'Thumbnail không được vượt quá 30MB.',
            'video_thumbnail.dimensions' => 'Ảnh có độ phân giải quá lớn (tối đa 8000x8000px). Vui lòng dùng ảnh nhỏ hơn.',
        ];
    }
}