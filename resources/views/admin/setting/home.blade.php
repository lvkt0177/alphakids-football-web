@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/vendor/cropper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/hero-crop.css') }}?v={{ filemtime(public_path('css/admin/hero-crop.css')) }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/admin/setting.js') }}?v={{ filemtime(public_path('js/admin/setting.js')) }}"></script>
    <script src="{{ asset('js/vendor/cropper.min.js') }}"></script>
    <script src="{{ asset('js/admin/hero-crop.js') }}?v={{ filemtime(public_path('js/admin/hero-crop.js')) }}"></script>
@endpush

@section('title', 'Nội dung Trang chủ')
@section('page-title', 'Nội dung Trang chủ')
@section('page-desc', 'Quản lý hình ảnh, video và hoạt động nổi bật hiển thị trên trang chủ.')

@section('content')
    <div class="tabs">
        <button type="button" class="tab-btn active" data-tab="images">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:14px;height:14px;vertical-align:-2px;margin-right:5px;"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="m3 16 5-5 4 4 5-5 4 4"/><circle cx="8.5" cy="9" r="1.4"/></svg>
            Hình ảnh
        </button>
        <button type="button" class="tab-btn" data-tab="video">Video</button>
        <button type="button" class="tab-btn" data-tab="activities">Hoạt động nổi bật</button>
    </div>

    <div class="tab-panel active" id="tab-images">
        <form class="card" id="imagesForm" method="POST" action="{{ route('admin.setting.home.images.update') }}"
            enctype="multipart/form-data">
            @csrf

            <div class="card-header">
                <div>
                    <div class="card-title">Quản lý ảnh hiển thị</div>
                    <div class="card-subtitle">Thay ảnh cho từng vị trí trên trang chủ và các trang khác.</div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
                    Lưu ảnh
                </button>
            </div>

            @foreach (\App\Http\Controllers\Admin\SettingController::IMAGE_GROUPS as $group => $keys)
                <div class="image-group-title">{{ $group }}</div>
                <div class="image-grid">
                    @foreach ($keys as $key => $label)
                        @if ($key === 'home_banner')
                            @php
                                $mobileSource = $images['home_banner_mobile_source'] ?? null;
                                $mobileHasOwnSource = (bool) $mobileSource;
                                $mobileImageKey = $mobileSource ?: $images[$key];
                            @endphp
                            <div class="image-card hero-crop-card">
                                <div class="image-card-body">
                                    <div class="image-card-label">{{ $label }}</div>
                                    <div class="btn btn-secondary btn-sm btn-file">
                                        <input type="file" name="images[{{ $key }}]" id="heroCropSourceInput" accept="image/*">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 15V3m0 0 4 4m-4-4-4 4"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2"/></svg>
                                        Chọn ảnh mới
                                    </div>
                                    @error('images.' . $key)
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror

                                    <div class="hero-crop-tools" id="heroCropTools" data-mobile-has-own-source="{{ $mobileHasOwnSource ? '1' : '' }}" @if (! $images[$key]) style="display:none" @endif>
                                        <div class="hero-crop-tool">
                                            <div class="hero-crop-tool__label-row">
                                                <span class="hero-crop-tool__label">Vùng hiển thị - Desktop (21:9)</span>
                                            </div>
                                            <p class="hero-crop-tool__note">Ảnh chính, dùng cho toàn bộ banner Desktop.</p>
                                            <div class="hero-crop-tool__frame">
                                                <img id="heroCropImgDesktop" @if ($images[$key]) src="{{ asset('storage/' . $images[$key]) }}" @endif alt="">
                                            </div>
                                        </div>
                                        <div class="hero-crop-tool">
                                            <div class="hero-crop-tool__label-row">
                                                <span class="hero-crop-tool__label">Vùng hiển thị - Mobile (4:5)</span>
                                                <div class="btn btn-secondary btn-sm btn-file">
                                                    <input type="file" name="images[home_banner_mobile_source]" id="heroCropMobileSourceInput" accept="image/*">
                                                    Ảnh riêng cho Mobile
                                                </div>
                                            </div>
                                            <p class="hero-crop-tool__note" id="heroCropMobileSourceNote">
                                                @if ($mobileHasOwnSource)
                                                    Đang dùng ảnh riêng cho Mobile.
                                                @else
                                                    Chưa có ảnh riêng - đang crop tạm trên ảnh Desktop.
                                                @endif
                                            </p>
                                            @error('images.home_banner_mobile_source')
                                                <p class="field-error">{{ $message }}</p>
                                            @enderror
                                            <div class="hero-crop-tool__frame">
                                                <img id="heroCropImgMobile" @if ($mobileImageKey) src="{{ asset('storage/' . $mobileImageKey) }}" @endif alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <p class="hero-crop-hint">Kéo/resize khung để chọn vùng ảnh hiển thị riêng cho Web và Mobile. Vùng chọn được lưu khi bấm "Lưu ảnh".</p>

                                    <input type="hidden" name="crop_desktop[x]" id="cropDesktopX" disabled>
                                    <input type="hidden" name="crop_desktop[y]" id="cropDesktopY" disabled>
                                    <input type="hidden" name="crop_desktop[width]" id="cropDesktopW" disabled>
                                    <input type="hidden" name="crop_desktop[height]" id="cropDesktopH" disabled>
                                    <input type="hidden" name="crop_mobile[x]" id="cropMobileX" disabled>
                                    <input type="hidden" name="crop_mobile[y]" id="cropMobileY" disabled>
                                    <input type="hidden" name="crop_mobile[width]" id="cropMobileW" disabled>
                                    <input type="hidden" name="crop_mobile[height]" id="cropMobileH" disabled>
                                    <input type="hidden" id="heroCropDesktopInitial" value="{{ $heroCropDesktop ? json_encode($heroCropDesktop) : '' }}">
                                    <input type="hidden" id="heroCropMobileInitial" value="{{ $heroCropMobile ? json_encode($heroCropMobile) : '' }}">
                                </div>
                            </div>
                        @elseif ($key === 'home_banner_mobile_source')
                            @continue
                        @else
                            <div class="image-card">
                                <div class="image-preview">
                                    @if ($images[$key])
                                        <img src="{{ asset('storage/' . $images[$key]) }}" alt="{{ $label }}">
                                    @else
                                        <div class="image-placeholder">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="m3 16 5-5 4 4 5-5 4 4"/><circle cx="8.5" cy="9" r="1.4"/></svg>
                                            <span>Chưa có ảnh</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="image-card-body">
                                    <div class="image-card-label">{{ $label }}</div>
                                    <div class="btn btn-secondary btn-sm btn-file">
                                        <input type="file" name="images[{{ $key }}]" accept="image/*">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 15V3m0 0 4 4m-4-4-4 4"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2"/></svg>
                                        Chọn ảnh mới
                                    </div>
                                    @error('images.' . $key)
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </form>
    </div>

    <div class="tab-panel" id="tab-video">
        <form class="card" method="POST" action="{{ route('admin.setting.home.video.update') }}"
            enctype="multipart/form-data">
            @csrf

            <div class="card-header">
                <div>
                    <div class="card-title">Video mục Trang chủ</div>
                    <div class="card-subtitle">Dán link YouTube hoặc tải file video lên.</div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
                    Lưu video
                </button>
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

            <div class="field">
                <label for="video_thumbnail">Ảnh thumbnail (hiện trước khi bấm play)</label>
                <div class="btn btn-secondary btn-file" style="max-width:220px;">
                    <input type="file" id="video_thumbnail" name="video_thumbnail" accept="image/*">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 15V3m0 0 4 4m-4-4-4 4"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2"/></svg>
                    Chọn ảnh thumbnail
                </div>
                <div class="field-hint">Ảnh JPG/PNG, tối đa 5MB. Chỉ áp dụng cho chế độ "Tải file video lên" - chế độ YouTube tự dùng thumbnail riêng của YouTube.</div>
                @error('video_thumbnail')
                    <p class="field-error">{{ $message }}</p>
                @enderror
                @if ($videoThumbnail)
                    <div class="video-preview-box">
                        <img src="{{ asset('storage/' . $videoThumbnail) }}" alt="Thumbnail video" style="width:100%;border-radius:8px;display:block;">
                    </div>
                @endif
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
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 15V3m0 0 4 4m-4-4-4 4"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2"/></svg>
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

        @if ($videoFile)
            <form method="POST" action="{{ route('admin.setting.home.video.delete') }}"
                data-confirm="Xóa video đã tải lên? Mục video trên trang chủ sẽ tự ẩn đi cho đến khi bạn tải video khác."
                data-confirm-title="Xóa video" style="margin-top:12px;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Xóa video đã tải lên</button>
            </form>
        @endif
    </div>

    <div class="tab-panel" id="tab-activities">
        <form class="card" method="POST" action="{{ route('admin.setting.home.activities.update') }}">
            @csrf

            <div class="card-header">
                <div>
                    <div class="card-title">Hoạt động hiển thị trên Trang chủ</div>
                    <div class="card-subtitle">Chọn tối đa 6 hoạt động, nhập số thứ tự hiển thị.</div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
                    Lưu thay đổi
                </button>
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
                    <li>
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 3v3M12 18v3M3 12h3M18 12h3"/><circle cx="12" cy="12" r="3"/></svg>
                            </div>
                            <div class="empty-state-title">Chưa có hoạt động nào để chọn</div>
                            <div class="empty-state-desc">Thêm hoạt động ở mục Hoạt động &amp; Sự kiện trước.</div>
                        </div>
                    </li>
                @endforelse
            </ul>
        </form>
    </div>
@endsection
