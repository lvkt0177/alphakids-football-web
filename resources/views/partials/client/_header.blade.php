@php
    $navItems = [
        ['label' => 'TRANG CHỦ', 'route' => 'home'],
        ['label' => 'VỀ CLB', 'route' => 'about'],
        ['label' => 'PHƯƠNG PHÁP', 'route' => 'method'],
        ['label' => 'CHƯƠNG TRÌNH DẠY', 'route' => 'program'],
        ['label' => 'HOẠT ĐỘNG & SỰ KIỆN', 'route' => 'activity.index'],
        ['label' => 'HỆ THỐNG CƠ SỞ', 'route' => 'branch.index'],
        ['label' => 'CÂU HỎI THƯỜNG GẶP', 'route' => 'faq'],
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
