@extends('layouts.admin')

@section('title', $proofPoint->exists ? 'Sửa nội dung' : 'Thêm nội dung')
@section('page-title', $proofPoint->exists ? 'Sửa nội dung' : 'Thêm nội dung')
@section('page-desc', 'Hiển thị ở mục "Vì sao phụ huynh chọn Alpha Kids" trên Trang chủ, dạng trích dẫn cảm nhận thật từ phụ huynh.')

@section('content')
    <form class="card" method="POST"
        action="{{ $proofPoint->exists ? route('admin.proof-point.update', $proofPoint) : route('admin.proof-point.store') }}">
        @csrf
        @if ($proofPoint->exists) @method('PUT') @endif

        <div class="card-header">
            <div>
                <div class="card-title">Thông tin nội dung</div>
                <div class="card-subtitle">Hiển thị ở mục "Vì sao phụ huynh chọn Alpha Kids" trên Trang chủ.</div>
            </div>
        </div>

        <div class="form-grid">
            <div class="field">
                <label for="author_name">Tên phụ huynh</label>
                <input type="text" id="author_name" name="author_name" required
                    value="{{ old('author_name', $proofPoint->author_name) }}" placeholder="Vd: Chị Lan Anh">
                @error('author_name') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="sort_order">Thứ tự hiển thị</label>
                <input type="number" id="sort_order" name="sort_order"
                    value="{{ old('sort_order', $proofPoint->sort_order) }}">
                @error('sort_order') <p class="field-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="field">
            <label for="description">Nội dung trích dẫn</label>
            <textarea id="description" name="description" rows="4" required>{{ old('description', $proofPoint->description) }}</textarea>
            @error('description') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        <hr class="divider">

        <div class="field">
            <input type="hidden" name="is_active" value="0">
            <label class="field-check-label">
                <input type="checkbox" name="is_active" value="1"
                    {{ old('is_active', $proofPoint->is_active ?? true) ? 'checked' : '' }}>
                Hiển thị ở Trang chủ
            </label>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.proof-point.index') }}" class="btn btn-secondary">Hủy</a>
            <button type="submit" class="btn btn-primary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
                {{ $proofPoint->exists ? 'Lưu thay đổi' : 'Thêm nội dung' }}
            </button>
        </div>
    </form>
@endsection
