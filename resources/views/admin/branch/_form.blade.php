@extends('layouts.admin')

@section('title', $branch->exists ? 'Sửa cơ sở' : 'Thêm cơ sở')
@section('page-title', $branch->exists ? 'Sửa cơ sở' : 'Thêm cơ sở')
@section('page-desc', 'Thông tin cơ sở hiển thị ở trang Hệ thống cơ sở.')

@section('content')
    <form class="card" method="POST"
        action="{{ $branch->exists ? route('admin.branch.update', $branch) : route('admin.branch.store') }}"
        enctype="multipart/form-data">
        @csrf
        @if ($branch->exists) @method('PUT') @endif

        <div class="card-header">
            <div class="card-title">Thông tin cơ sở</div>
        </div>

        <div class="form-grid">
            <div class="field">
                <label for="name">Tên cơ sở</label>
                <input type="text" id="name" name="name" value="{{ old('name', $branch->name) }}">
                @error('name') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="slug">Slug (đường dẫn)</label>
                <input type="text" id="slug" name="slug" value="{{ old('slug', $branch->slug) }}" placeholder="hoang-anh">
                @error('slug') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="address">Địa chỉ</label>
                <input type="text" id="address" name="address" value="{{ old('address', $branch->address) }}">
                @error('address') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="image">Hình ảnh</label>
                <input type="file" id="image" name="image" accept="image/*">
                @if ($branch->image)
                    <div class="field-hint">Ảnh hiện tại: {{ $branch->image }}</div>
                @endif
                @error('image') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="schedule_weekday">Lịch học ngày thường</label>
                <input type="text" id="schedule_weekday" name="schedule_weekday"
                    value="{{ old('schedule_weekday', $branch->schedule_weekday) }}" placeholder="Thứ 3 - Thứ 5">
                @error('schedule_weekday') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="schedule_weekend">Lịch học cuối tuần</label>
                <input type="text" id="schedule_weekend" name="schedule_weekend"
                    value="{{ old('schedule_weekend', $branch->schedule_weekend) }}" placeholder="Thứ 7 - CN">
                @error('schedule_weekend') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="sort_order">Thứ tự hiển thị</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $branch->sort_order) }}">
                @error('sort_order') <p class="field-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="field">
            <label>Đặc điểm nổi bật (tối đa 4)</label>
            @php $features = old('features', $branch->features ?? ['', '', '', '']); @endphp
            @for ($i = 0; $i < 4; $i++)
                <input type="text" name="features[]" value="{{ $features[$i] ?? '' }}"
                    placeholder="Đặc điểm {{ $i + 1 }}" style="margin-bottom:8px;">
            @endfor
            @error('features') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="map_embed_url">Link nhúng Google Maps (src iframe)</label>
            <input type="text" id="map_embed_url" name="map_embed_url" value="{{ old('map_embed_url', $branch->map_embed_url) }}">
            @error('map_embed_url') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <input type="hidden" name="is_active" value="0">
            <label style="display:flex;align-items:center;gap:8px;font-weight:400;">
                <input type="checkbox" name="is_active" value="1" style="width:auto;"
                    {{ old('is_active', $branch->is_active ?? true) ? 'checked' : '' }}>
                Đang hoạt động (hiển thị ra trang Client)
            </label>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.branch.index') }}" class="btn btn-secondary">Hủy</a>
            <button type="submit" class="btn btn-primary">{{ $branch->exists ? 'Lưu thay đổi' : 'Thêm cơ sở' }}</button>
        </div>
    </form>
@endsection