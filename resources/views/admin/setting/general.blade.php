@extends('layouts.admin')

@section('title', 'Thông tin chung')
@section('page-title', 'Thông tin chung')
@section('page-desc', 'Thông tin liên hệ và mạng xã hội, đồng bộ tới Footer và các trang liên quan.')

@section('content')
    <form class="card" method="POST" action="{{ route('admin.setting.general.update') }}">
        @csrf

        <div class="card-header">
            <div class="card-title">Thông tin liên hệ</div>
        </div>

        <div class="section-note">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 8v5"/><path d="M12 16h.01"/></svg>
            Các trường này đồng bộ hiển thị ở: Footer, trang Câu hỏi thường gặp, trang Liên hệ &amp; Đăng ký học thử.
        </div>

        <div class="form-grid">
            <div class="field">
                <label for="hotline">Hotline</label>
                <input type="text" id="hotline" name="hotline" value="{{ old('hotline', $fields['hotline']) }}"
                    placeholder="0909 123 456">
                @error('hotline')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="zalo_contact">Zalo</label>
                <input type="text" id="zalo_contact" name="zalo_contact"
                    value="{{ old('zalo_contact', $fields['zalo_contact']) }}" placeholder="Số Zalo tư vấn">
                @error('zalo_contact')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="{{ old('email', $fields['email']) }}">
                @error('email')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="address">Địa chỉ trụ sở</label>
                <input type="text" id="address" name="address" value="{{ old('address', $fields['address']) }}">
                @error('address')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="consulting_hours">Thời gian tư vấn</label>
                <input type="text" id="consulting_hours" name="consulting_hours"
                    value="{{ old('consulting_hours', $fields['consulting_hours']) }}" placeholder="8:00 - 20:00 hàng ngày">
                @error('consulting_hours')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <hr class="divider">

        <div class="card-header">
            <div class="card-title">Mạng xã hội</div>
        </div>

        <div class="section-note">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 8v5"/><path d="M12 16h.01"/></svg>
            Các trường này hiển thị ở Footer.
        </div>

        <div class="form-grid">
            <div class="field">
                <label for="facebook_url">Facebook</label>
                <input type="text" id="facebook_url" name="facebook_url"
                    value="{{ old('facebook_url', $fields['facebook_url']) }}" placeholder="https://facebook.com/...">
                @error('facebook_url')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="tiktok_url">TikTok</label>
                <input type="text" id="tiktok_url" name="tiktok_url"
                    value="{{ old('tiktok_url', $fields['tiktok_url']) }}" placeholder="https://tiktok.com/@...">
                @error('tiktok_url')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="zalo_url">Zalo (link)</label>
                <input type="text" id="zalo_url" name="zalo_url" value="{{ old('zalo_url', $fields['zalo_url']) }}"
                    placeholder="https://zalo.me/...">
                @error('zalo_url')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
                Lưu thay đổi
            </button>
        </div>
    </form>
@endsection
