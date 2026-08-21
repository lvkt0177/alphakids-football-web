<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Alpha Kids Football Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&family=Fredoka:wght@600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}?v={{ filemtime(public_path('css/auth/login.css')) }}">
</head>

<body>

    <div class="login-shell">
        <div class="login-form">
            <div class="brand">
                <div class="brand-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 9 12 5 2 9l10 4 10-4Z" />
                        <path d="M6 11v4c0 1.5 2.7 3 6 3s6-1.5 6-3v-4" />
                        <path d="M22 9v6" />
                    </svg>
                </div>
                <span class="brand-name">Alpha Kids Football</span>
            </div>

            <h1>Chào mừng trở lại!</h1>
            <p class="lead">Đăng nhập để quản lý hệ thống Alpha Kids Football</p>

            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                <div class="field-group {{ $errors->has('username') ? 'error' : '' }}">
                    <label for="username">Tên đăng nhập</label>
                    <div class="input-wrap">
                        <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập"
                            value="{{ old('username') }}" autocomplete="off" autofocus>
                    </div>
                    @if ($errors->has('username'))
                        <p class="error-text">{{ $errors->first('username') }}</p>
                    @endif
                </div>

                <div class="field-group {{ $errors->has('password') ? 'error' : '' }}">
                    <label for="password">Mật khẩu</label>
                    <div class="input-wrap">
                        <input type="password" id="password" name="password" placeholder="Nhập mật khẩu"
                            autocomplete="current-password">
                        <button type="button" class="toggle-password" id="togglePassword" aria-label="Hiện mật khẩu">
                            <svg id="eyeIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </button>
                    </div>
                    @if ($errors->has('password'))
                        <p class="error-text">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <button type="submit" class="btn-submit">
                    <span id="submitLabel">Đăng nhập</span>
                </button>
            </form>
        </div>

        <div class="login-photo">
            <img src="{{ asset('images/auth/login-hero.jpg') }}" alt="">
            <div class="tagline">Alpha Kids Football</div>
        </div>
    </div>

    <script src="{{ asset('js/auth/login.js') }}?v={{ filemtime(public_path('js/auth/login.js')) }}"></script>
</body>

</html>
