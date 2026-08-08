<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Alpha Kids Football</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}?v={{ filemtime(public_path('css/admin/app.css')) }}">
    @stack('styles')
</head>

<body>
    <div class="app">
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        @include('partials.admin._sidebar')

        <div class="main">
            @include('partials.admin._topbar')

            <main class="content">
                @if (session('success'))
                    <div class="toast show"
                        style="position:static;transform:none;opacity:1;margin-bottom:16px;display:inline-flex;">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('js/admin/app.js') }}?v={{ filemtime(public_path('js/admin/app.js')) }}"></script>
    @stack('scripts')
</body>

</html>
