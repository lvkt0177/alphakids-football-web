@extends('layouts.admin')

@section('title', $activity->exists ? 'Sửa hoạt động' : 'Thêm hoạt động')
@section('page-title', $activity->exists ? 'Sửa hoạt động' : 'Thêm hoạt động')
@section('page-desc', 'Thông tin hoạt động hiển thị ở trang Hoạt động & Sự kiện.')

@push('styles')
    <link rel="stylesheet"
        href="{{ asset('css/admin/activity-gallery.css') }}?v={{ filemtime(public_path('css/admin/activity-gallery.css')) }}">
@endpush

@section('content')
    <form class="card" method="POST"
        action="{{ $activity->exists ? route('admin.activity.update', $activity) : route('admin.activity.store') }}"
        enctype="multipart/form-data">
        @csrf
        @if ($activity->exists)
            @method('PUT')
        @endif

        <div class="card-header">
            <div>
                <div class="card-title">Thông tin hoạt động</div>
                <div class="card-subtitle">Các trường hiển thị công khai ở trang Hoạt động &amp; Sự kiện.</div>
            </div>
        </div>

        <div class="form-grid">
            <div class="field">
                <label for="name">Tên hoạt động</label>
                <input type="text" id="name" name="name" value="{{ old('name', $activity->name) }}">
                @error('name')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="category">Danh mục</label>
                <select id="category" name="category">
                    @foreach (\App\Enums\ActivityCategory::cases() as $cat)
                        <option value="{{ $cat->value }}"
                            {{ old('category', $activity->category?->value) == $cat->value ? 'selected' : '' }}>
                            {{ $cat->getLabel() }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="image">Hình ảnh</label>
                <input type="file" id="image" name="image" accept="image/*">
                @if ($activity->image)
                    <div class="field-hint">Ảnh hiện tại: {{ $activity->image }}</div>
                @endif
                @error('image')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="sort_order">Thứ tự hiển thị</label>
                <input type="number" id="sort_order" name="sort_order"
                    value="{{ old('sort_order', $activity->sort_order) }}">
                @error('sort_order')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="featured_order">Thứ tự nổi bật (nếu có)</label>
                <input type="number" id="featured_order" name="featured_order"
                    value="{{ old('featured_order', $activity->featured_order) }}">
                @error('featured_order')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="field">
            <label for="description">Mô tả ngắn</label>
            <textarea id="description" name="description" rows="4">{{ old('description', $activity->description) }}</textarea>
            @error('description')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <hr class="divider">

        <div class="field">
            <input type="hidden" name="is_featured" value="0">
            <label class="field-check-label">
                <input type="checkbox" name="is_featured" value="1"
                    {{ old('is_featured', $activity->is_featured) ? 'checked' : '' }}>
                Hiển thị ở mục "Hoạt động nổi bật" trên Trang chủ
            </label>
        </div>

        <div class="field">
            <input type="hidden" name="is_active" value="0">
            <label class="field-check-label">
                <input type="checkbox" name="is_active" value="1"
                    {{ old('is_active', $activity->is_active ?? true) ? 'checked' : '' }}>
                Đang hoạt động (hiển thị ra trang Client)
            </label>
        </div>

        <hr class="divider">

        <div class="card-header">
            <div>
                <div class="card-title">Thư viện ảnh &amp; video</div>
                <div class="card-subtitle">Ảnh và video hiển thị trong gallery ở trang chi tiết &ldquo;{{ $activity->name ?: 'hoạt động này' }}&rdquo;.
                    Mục đầu tiên trong danh sách hiển thị đầu tiên trên trang. Video tối đa 500MB (MP4, MOV, WebM).</div>
            </div>
        </div>

        <div class="gallery-grid" id="galleryGrid"
            data-temp-upload-url="{{ route('admin.activity.media.temp-upload') }}">
            @forelse ($activity->images as $image)
                <div class="gallery-tile" data-id="{{ $image->id }}">
                    <div class="gallery-tile__media">
                        @if ($image->isVideo())
                            <video src="{{ asset('storage/' . $image->image) }}" muted playsinline preload="metadata"></video>
                            <span class="gallery-tile__badge gallery-tile__badge--video">Video</span>
                        @else
                            <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->alt_text }}">
                        @endif
                        <span class="gallery-tile__order"></span>
                        <div class="gallery-tile__actions">
                            <div class="gallery-order-btns">
                                <button type="button" class="gallery-icon-btn gallery-move-up" title="Lên trước">
                                    <svg viewBox="0 0 24 24"><path d="M12 19V5M5 12l7-7 7 7" /></svg>
                                </button>
                                <button type="button" class="gallery-icon-btn gallery-move-down" title="Xuống sau">
                                    <svg viewBox="0 0 24 24"><path d="M12 5v14M19 12l-7 7-7-7" /></svg>
                                </button>
                            </div>
                            <button type="button" class="gallery-icon-btn gallery-icon-btn--danger gallery-mark-delete"
                                title="Xóa">
                                <svg viewBox="0 0 24 24"><path d="M6 6l12 12M18 6L6 18" /></svg>
                            </button>
                        </div>
                    </div>
                    <div class="gallery-tile__undo">
                        <span>Sẽ xóa khi lưu</span>
                        <button type="button" class="gallery-undo">Hoàn tác</button>
                    </div>
                </div>
            @empty
            @endforelse

            <label class="gallery-dropzone" id="galleryDropzone">
                <svg viewBox="0 0 24 24"><path d="M12 4v12M6 10l6-6 6 6" /><path d="M4 18h16" /></svg>
                <span>Thêm ảnh / video</span>
                <input type="file" accept="image/*,video/mp4,video/quicktime,video/webm,.mp4,.mov,.webm,.m4v" multiple id="galleryFileInput">
            </label>
        </div>

        <input type="hidden" name="gallery_state" id="galleryState" value="[]">
        <div id="galleryWarnings"></div>
        <span class="gallery-upload-status" id="galleryUploadStatus"></span>

        <div class="form-actions">
            <a href="{{ route('admin.activity.index') }}" class="btn btn-secondary">Hủy</a>
            <button type="submit" class="btn btn-primary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M5 13l4 4L19 7" />
                </svg>
                {{ $activity->exists ? 'Lưu thay đổi' : 'Thêm hoạt động' }}
            </button>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/activity-gallery.js') }}?v={{ filemtime(public_path('js/admin/activity-gallery.js')) }}"></script>
@endpush
