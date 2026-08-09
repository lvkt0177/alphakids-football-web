@php
    // Nguồn dữ liệu menu duy nhất, dùng lại cho cả menu desktop và menu mobile.
    // "Dành cho phụ huynh" trỏ sang trang Câu hỏi thường gặp (đã xác nhận).
    $navItems = [
        ['label' => 'Trang chủ', 'route' => 'home'],
        ['label' => 'Về CLB', 'route' => 'about'],
        ['label' => 'Phương pháp', 'route' => 'method'],
        ['label' => 'Chương trình dạy', 'route' => 'program'],
        ['label' => 'Hoạt động & Sự kiện', 'route' => 'activity.index'],
        ['label' => 'Hệ thống cơ sở', 'route' => 'branch.index'],
        ['label' => 'Dành cho phụ huynh', 'route' => 'faq'],
    ];
@endphp

<header class="site-header site-header--{{ $variant }}" id="siteHeader">
    <div class="site-header__inner container">
        <a href="{{ route('home') }}" class="site-header__brand">
            <img src="{{ asset('images/logo/logo.jpg') }}" alt="Alpha Kids Football Club" class="site-header__logo">
            <span class="site-header__brand-text">
                <strong>ALPHA KIDS</strong>
                <small>FOOTBALL CLUB</small>
            </span>
        </a>

        <nav class="site-header__nav" aria-label="Menu chính">
            <ul>
                @foreach ($navItems as $item)
                    <li>
                        <a href="{{ route($item['route']) }}"
                            class="{{ request()->routeIs($item['route']) ? 'is-active' : '' }}">
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="site-header__actions">
            <a href="{{ route('registration.create') }}" class="btn btn--accent site-header__cta">
                Đăng ký học thử
            </a>

            <button type="button" class="site-header__toggle" id="menuToggle" aria-label="Mở menu"
                aria-expanded="false" aria-controls="mobileMenu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>

<div class="mobile-menu" id="mobileMenu" aria-hidden="true">
    <div class="mobile-menu__overlay" id="mobileMenuOverlay"></div>

    <nav class="mobile-menu__panel" aria-label="Menu di động">
        <button type="button" class="mobile-menu__close" id="menuClose" aria-label="Đóng menu">
            &times;
        </button>

        <ul>
            @foreach ($navItems as $item)
                <li>
                    <a href="{{ route($item['route']) }}"
                        class="{{ request()->routeIs($item['route']) ? 'is-active' : '' }}">
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        <a href="{{ route('registration.create') }}" class="btn btn--accent btn--block mobile-menu__cta">
            Đăng ký học thử
        </a>
    </nav>
</div>
