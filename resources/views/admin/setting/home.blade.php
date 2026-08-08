@extends('layouts.admin')

@push('scripts')
    <script src="{{ asset('js/admin/setting.js') }}?v={{ filemtime(public_path('js/admin/setting.js')) }}"></script>
@endpush

@section('title', 'Nội dung Trang chủ')
@section('page-title', 'Nội dung Trang chủ')
@section('page-desc', 'Quản lý hình ảnh, video và hoạt động nổi bật hiển thị trên trang chủ.')

@section('content')
    <div class="tabs">
        <button type="button" class="tab-btn active" data-tab="images">Hình ảnh</button>
        <button type="button" class="tab-btn" data-tab="video">Video</button>
        <button type="button" class="tab-btn" data-tab="activities">Hoạt động nổi bật</button>
    </div>

    {{-- Tab: Hình ảnh --}}
    <div class="tab-panel active" id="tab-images">
        <form class="card" method="POST" action="{{ route('admin.setting.home.images.update') }}"
            enctype="multipart/form-data">
            @csrf

            <div class="card-header">
                <div>
                    <div class="card-title">Quản lý ảnh hiển thị</div>
                    <div class="card-subtitle">Thay ảnh cho từng vị trí trên trang chủ và các trang khác.</div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Lưu ảnh</button>
            </div>

            @foreach (\App\Http\Controllers\Admin\SettingController::IMAGE_GROUPS as $group => $keys)
                <div class="image-group-title">{{ $group }}</div>
                <div class="image-grid">
                    @foreach ($keys as $key => $label)
                        <div class="image-card">
                            <div class="image-preview">
                                @if ($images[$key])
                                    <img src="{{ asset('storage/' . $images[$key]) }}" alt="{{ $label }}">
                                @else
                                    <div class="image-placeholder">
                                        <span>Chưa có ảnh</span>
                                    </div>
                                @endif
                            </div>
                            <div class="image-card-body">
                                <div class="image-card-label">{{ $label }}</div>
                                <div class="btn btn-secondary btn-sm btn-file">
                                    <input type="file" name="images[{{ $key }}]" accept="image/*">
                                    Chọn ảnh mới
                                </div>
                                @error('images.' . $key)
                                    <p class="field-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </form>
    </div>

    {{-- Tab: Video --}}
    <div class="tab-panel" id="tab-video">
        <form class="card" method="POST" action="{{ route('admin.setting.home.video.update') }}"
            enctype="multipart/form-data">
            @csrf

            <div class="card-header">
                <div>
                    <div class="card-title">Video mục Trang chủ</div>
                    <div class="card-subtitle">Dán link YouTube hoặc tải file video lên.</div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Lưu video</button>
            </div>

            <div class="radio-toggle">
                <label>
                    <input type="radio" name="video_mode" value="youtube" {{ $videoMode == 'youtube' ? 'checked' : '' }}>
                    <span>Dán link YouTube</span>
                </label>
                <label>
                    <input type="radio" name="video_mode" value="upload" {{ $videoMode == 'upload' ? 'checked' : '' }}>
                    <span>Tải file video lên</span>
                </label>
            </div>

            <div class="video-input-mode {{ $videoMode == 'youtube' ? 'active' : '' }}" id="mode-youtube">
                <div class="field">
                    <label for="video_youtube_url">Link video YouTube</label>
                    <input type="url" id="video_youtube_url" name="video_youtube_url"
                        value="{{ old('video_youtube_url', $youtubeUrl) }}"
                        placeholder="https://www.youtube.com/watch?v=...">
                    @error('video_youtube_url')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="video-input-mode {{ $videoMode == 'upload' ? 'active' : '' }}" id="mode-upload">
                <div class="field">
                    <label for="video_file">Tải file video</label>
                    <div class="btn btn-secondary btn-file" style="max-width:220px;">
                        <input type="file" id="video_file" name="video_file" accept="video/mp4">
                        Chọn file video
                    </div>
                    <div class="field-hint">Định dạng MP4, tối đa 200MB.</div>
                    @error('video_file')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>
                @if ($videoFile)
                    <div class="video-preview-box">
                        <video controls muted src="{{ asset('storage/' . $videoFile) }}"></video>
                    </div>
                @endif
            </div>
        </form>
    </div>

    {{-- Tab: Hoạt động nổi bật --}}
    <div class="tab-panel" id="tab-activities">
        <form class="card" method="POST" action="{{ route('admin.setting.home.activities.update') }}">
            @csrf

            <div class="card-header">
                <div>
                    <div class="card-title">Hoạt động hiển thị trên Trang chủ</div>
                    <div class="card-subtitle">Chọn tối đa 6 hoạt động, nhập số thứ tự hiển thị.</div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Lưu thay đổi</button>
            </div>

            @error('activities')
                <p class="field-error">{{ $message }}</p>
            @enderror

            <ul class="activity-list">
                @forelse ($activities as $activity)
                    <li class="activity-row">
                        <input type="checkbox" name="activities[]" value="{{ $activity->id }}"
                            {{ $activity->is_featured ? 'checked' : '' }}>
                        <div class="activity-info">
                            <div class="activity-name">{{ $activity->name }}</div>
                        </div>
                        <span class="order-label">Vị trí</span>
                        <input type="number" class="order-input" min="1" value="{{ $activity->featured_order }}"
                            readonly>
                    </li>
                @empty
                    <li>Chưa có hoạt động nào để chọn.</li>
                @endforelse
            </ul>
        </form>
    </div>
@endsection
