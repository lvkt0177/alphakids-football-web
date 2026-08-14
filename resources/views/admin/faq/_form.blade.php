@extends('layouts.admin')

@section('title', $faq->exists ? 'Sửa câu hỏi' : 'Thêm câu hỏi')
@section('page-title', $faq->exists ? 'Sửa câu hỏi' : 'Thêm câu hỏi')
@section('page-desc', 'Bật "Hiển thị ở Trang chủ" để câu hỏi này xuất hiện trong khối Q&A cuối phần Hành trình phát triển 4 tư duy. Trang FAQ riêng luôn hiển thị mọi câu hỏi đang bật trạng thái Hiển thị.')

@section('content')
    <form class="card" method="POST"
        action="{{ $faq->exists ? route('admin.faq.update', $faq) : route('admin.faq.store') }}">
        @csrf
        @if ($faq->exists) @method('PUT') @endif

        <div class="card-header">
            <div>
                <div class="card-title">Nội dung câu hỏi</div>
                <div class="card-subtitle">Hiển thị ở trang "Câu hỏi thường gặp" và Trang chủ (nếu được bật).</div>
            </div>
        </div>

        <div class="field">
            <label for="question">Câu hỏi</label>
            <input type="text" id="question" name="question" value="{{ old('question', $faq->question) }}"
                placeholder="Vd: Alpha Kids nhận học viên từ mấy tuổi?">
            @error('question') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="answer">Câu trả lời</label>
            <textarea id="answer" name="answer" rows="4">{{ old('answer', $faq->answer) }}</textarea>
            @error('answer') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="sort_order">Thứ tự hiển thị</label>
            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $faq->sort_order) }}">
            @error('sort_order') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        <hr class="divider">

        <div class="field">
            <input type="hidden" name="is_active" value="0">
            <label class="field-check-label">
                <input type="checkbox" name="is_active" value="1"
                    {{ old('is_active', $faq->is_active ?? true) ? 'checked' : '' }}>
                Hiển thị (trang FAQ)
            </label>
        </div>

        <div class="field">
            <input type="hidden" name="show_on_home" value="0">
            <label class="field-check-label">
                <input type="checkbox" name="show_on_home" value="1"
                    {{ old('show_on_home', $faq->show_on_home ?? false) ? 'checked' : '' }}>
                Hiển thị ở Trang chủ (khối Q&amp;A cuối phần Hành trình phát triển)
            </label>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.faq.index') }}" class="btn btn-secondary">Hủy</a>
            <button type="submit" class="btn btn-primary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
                {{ $faq->exists ? 'Lưu thay đổi' : 'Thêm câu hỏi' }}
            </button>
        </div>
    </form>
@endsection
