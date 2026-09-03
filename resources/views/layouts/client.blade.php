<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Alpha Kids Football Club' }} - Bóng đá tư duy cho trẻ từ 3 tuổi</title>
    <meta name="description"
        content="{{ $description ?? 'Alpha Kids Football Club - CLB bóng đá tư duy dành cho trẻ từ 3 tuổi, phát triển thể chất, tư duy và nhân cách qua từng buổi tập.' }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Alpha Kids Football Club">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'Alpha Kids Football Club' }} - Bóng đá tư duy cho trẻ từ 3 tuổi">
    <meta property="og:description"
        content="{{ $description ?? 'Alpha Kids Football Club - CLB bóng đá tư duy dành cho trẻ từ 3 tuổi, phát triển thể chất, tư duy và nhân cách qua từng buổi tập.' }}">
    <meta property="og:image" content="{{ $ogImage ?? asset('images/logo/logo-website.png') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? 'Alpha Kids Football Club' }} - Bóng đá tư duy cho trẻ từ 3 tuổi">
    <meta name="twitter:description"
        content="{{ $description ?? 'Alpha Kids Football Club - CLB bóng đá tư duy dành cho trẻ từ 3 tuổi, phát triển thể chất, tư duy và nhân cách qua từng buổi tập.' }}">
    <meta name="twitter:image" content="{{ $ogImage ?? asset('images/logo/logo-website.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&family=Archivo:wght@600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="{{ asset('css/client/base.css') }}?v={{ filemtime(public_path('css/client/base.css')) }}">
    <link rel="stylesheet"
        href="{{ asset('css/client/layout.css') }}?v={{ filemtime(public_path('css/client/layout.css')) }}">
    @stack('styles')
</head>

<body>

    @include('partials.client._header', ['variant' => $headerVariant ?? 'solid'])

    <main>
        @yield('content')
    </main>

    @include('partials.client._footer')

    @include('partials.client._contact-fab')

    @include('partials.client._success-modal')

    <script src="{{ asset('js/client/app.js') }}?v={{ filemtime(public_path('js/client/app.js')) }}" defer></script>
    @stack('scripts')
</body>

</html>