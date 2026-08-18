@extends('layouts.admin')

@section('title', $branch->exists ? 'Sửa cơ sở' : 'Thêm cơ sở')
@section('page-title', $branch->exists ? 'Sửa cơ sở' : 'Thêm cơ sở')
@section('page-desc', 'Thông tin cơ sở hiển thị ở trang Hệ thống cơ sở.')

@php
    $scheduleDays = ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ Nhật'];
    $scheduleRows = old('schedule', $branch->schedule ?? []);
@endphp

@section('content')
    <form class="card" method="POST"
        action="{{ $branch->exists ? route('admin.branch.update', $branch) : route('admin.branch.store') }}"
        enctype="multipart/form-data">
        @csrf
        @if ($branch->exists)
            @method('PUT')
        @endif

        <div class="card-header">
            <div class="card-title">Thông tin cơ sở</div>
        </div>

        <div class="form-grid">
            <div class="field">
                <label for="name">Tên cơ sở</label>
                <input type="text" id="name" name="name" value="{{ old('name', $branch->name) }}">
                @error('name')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="location">Địa điểm cơ sở</label>
                <input type="text" id="location" name="location" value="{{ old('location', $branch->location) }}" placeholder="Đức Trọng">
                @error('location')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="address">Địa chỉ</label>
                <input type="text" id="address" name="address" value="{{ old('address', $branch->address) }}">
                @error('address')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="image">Hình ảnh</label>
                <input type="file" id="image" name="image" accept="image/*">
                @if ($branch->image)
                    <div class="field-hint">Ảnh hiện tại: {{ $branch->image }}</div>
                @endif
                @error('image')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="sort_order">Thứ tự hiển thị</label>
                <input type="number" id="sort_order" name="sort_order"
                    value="{{ old('sort_order', $branch->sort_order) }}">
                @error('sort_order')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="field">
            <label for="description">Mô tả ngắn (tùy chọn)</label>
            <textarea id="description" name="description" rows="3">{{ old('description', $branch->description) }}</textarea>
            <div class="field-hint">Hiện ở trang Hệ thống cơ sở, giúp phân biệt cơ sở này với cơ sở khác (vd: "Sân bãi mới cải tạo 2026").</div>
            @error('description')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label>Lịch học</label>
            <div class="schedule-box" id="scheduleBox">
                <div class="schedule-rows" id="scheduleRows">
                    @foreach ($scheduleRows as $i => $row)
                        <div class="schedule-row">
                            <select name="schedule[{{ $i }}][day]">
                                @foreach ($scheduleDays as $day)
                                    <option value="{{ $day }}"
                                        {{ ($row['day'] ?? '') === $day ? 'selected' : '' }}>{{ $day }}</option>
                                @endforeach
                            </select>
                            <input type="time" name="schedule[{{ $i }}][start]"
                                value="{{ $row['start'] ?? '' }}">
                            <span class="schedule-row__sep">–</span>
                            <input type="time" name="schedule[{{ $i }}][end]"
                                value="{{ $row['end'] ?? '' }}">
                            <button type="button" class="schedule-row__remove" aria-label="Xóa khung giờ này">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round">
                                    <path d="M18 6L6 18M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary btn-sm" id="addScheduleRow">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <path d="M12 5v14M5 12h14" />
                    </svg>
                    Thêm khung giờ
                </button>
            </div>
            @error('schedule')
                <p class="field-error">{{ $message }}</p>
            @enderror
            @foreach ($errors->get('schedule.*.day') + $errors->get('schedule.*.start') + $errors->get('schedule.*.end') as $messages)
                @foreach ($messages as $message)
                    <p class="field-error">{{ $message }}</p>
                @endforeach
            @endforeach
        </div>

        <template id="scheduleRowTemplate">
            <div class="schedule-row">
                <select name="">
                    @foreach ($scheduleDays as $day)
                        <option value="{{ $day }}">{{ $day }}</option>
                    @endforeach
                </select>
                <input type="time" name="">
                <span class="schedule-row__sep">–</span>
                <input type="time" name="">
                <button type="button" class="schedule-row__remove" aria-label="Xóa khung giờ này">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <path d="M18 6L6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </template>

        <hr class="divider">

        <div class="field">
            <label for="map_embed_url">Link nhúng Google Maps</label>
            <input type="text" id="map_embed_url" name="map_embed_url"
                value="{{ old('map_embed_url', $branch->map_embed_url) }}">
            @error('map_embed_url')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <input type="hidden" name="is_active" value="0">
            <label class="field-check-label">
                <input type="checkbox" name="is_active" value="1"
                    {{ old('is_active', $branch->is_active ?? true) ? 'checked' : '' }}>
                Đang hoạt động (hiển thị ra trang Client)
            </label>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.branch.index') }}" class="btn btn-secondary">Hủy</a>
            <button type="submit" class="btn btn-primary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M5 13l4 4L19 7" />
                </svg>
                {{ $branch->exists ? 'Lưu thay đổi' : 'Thêm cơ sở' }}
            </button>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/branch.js') }}?v={{ filemtime(public_path('js/admin/branch.js')) }}"></script>
@endpush
