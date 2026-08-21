@extends('layouts.admin')

@section('title', 'Đổi mật khẩu')
@section('page-title', 'Tài khoản')
@section('page-desc', 'Đổi mật khẩu đăng nhập cho tài khoản quản trị của bạn.')

@section('content')
    <form class="card" method="POST" action="{{ route('admin.account.password.update') }}">
        @csrf

        <div class="card-header">
            <div class="card-title">Đổi mật khẩu</div>
        </div>

        <div class="form-grid">
            <div class="field">
                <label for="current_password">Mật khẩu hiện tại</label>
                <input type="password" id="current_password" name="current_password" autocomplete="current-password">
                @error('current_password')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-grid">
            <div class="field">
                <label for="password">Mật khẩu mới</label>
                <input type="password" id="password" name="password" autocomplete="new-password">
                <p class="field-hint">Ít nhất 8 ký tự.</p>
                @error('password')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-grid">
            <div class="field">
                <label for="password_confirmation">Xác nhận mật khẩu mới</label>
                <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
                Đổi mật khẩu
            </button>
        </div>
    </form>
@endsection
