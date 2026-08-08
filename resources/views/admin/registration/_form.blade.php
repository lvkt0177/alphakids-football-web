@extends('layouts.admin')

@section('title', 'Sửa đăng ký học thử')
@section('page-title', 'Sửa đăng ký học thử')
@section('page-desc', 'Cập nhật trạng thái và thông tin đăng ký.')

@section('content')
    <form class="card" method="POST" action="{{ route('admin.registration.update', $registration) }}">
        @csrf
        @method('PUT')

        <div class="card-header">
            <div>
                <div class="card-title">{{ $registration->child_name }}</div>
                <div class="card-subtitle">Đăng ký lúc {{ $registration->created_at->format('d/m/Y H:i') }}</div>
            </div>
        </div>

        <div class="form-grid">
            <div class="field">
                <label for="child_name">Tên bé</label>
                <input type="text" id="child_name" name="child_name"
                    value="{{ old('child_name', $registration->child_name) }}">
                @error('child_name')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="birth_year">Năm sinh</label>
                <input type="number" id="birth_year" name="birth_year"
                    value="{{ old('birth_year', $registration->birth_year) }}">
                @error('birth_year')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="phone">Số điện thoại</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $registration->phone) }}">
                @error('phone')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="trial_date">Ngày trải nghiệm</label>
                <input type="date" id="trial_date" name="trial_date"
                    value="{{ old('trial_date', $registration->trial_date?->format('Y-m-d')) }}">
                @error('trial_date')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="status">Trạng thái</label>
                <select id="status" name="status">
                    @foreach (\App\Enums\RegistrationStatus::cases() as $status)
                        <option value="{{ $status->value }}"
                            {{ old('status', $registration->status->value) == $status->value ? 'selected' : '' }}>
                            {{ $status->getLabel() }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="field">
            <label>Cơ sở đăng ký</label>
            @foreach ($branches as $branch)
                <label style="display:flex;align-items:center;gap:8px;margin-bottom:8px;font-weight:400;">
                    <input type="checkbox" name="branches[]" value="{{ $branch->id }}" style="width:auto;"
                        {{ in_array($branch->id, old('branches', $registration->branches->pluck('id')->toArray())) ? 'checked' : '' }}>
                    {{ $branch->name }}
                </label>
            @endforeach
        </div>

        <div class="field">
            <label for="note">Ghi chú</label>
            <textarea id="note" name="note" rows="4">{{ old('note', $registration->note) }}</textarea>
            @error('note')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.registration.index') }}" class="btn btn-secondary">Hủy</a>
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </div>
    </form>

    <form method="POST" action="{{ route('admin.registration.destroy', $registration) }}"
        data-confirm="Bạn chắc chắn muốn xóa đăng ký của bé &quot;{{ $registration->child_name }}&quot;? Hành động này không thể hoàn tác."
        data-confirm-title="Xóa đăng ký">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Xóa đăng ký</button>
    </form>
@endsection
