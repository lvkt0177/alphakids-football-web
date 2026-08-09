@php
    // $siteSettings được SiteSettingsComposer tự động gán cho layout Client
    // và kế thừa xuống partial này (Blade @include chia sẻ chung scope biến).
    $siteSettings = $siteSettings ?? collect();
@endphp

<footer class="site-footer">
    <div class="site-footer__top container">
        <div class="site-footer__brand">
            <a href="{{ route('home') }}" class="site-footer__logo">
                <img src="{{ asset('images/logo/logo.jpg') }}" alt="Alpha Kids Football Club">
                <span>
                    <strong>ALPHA KIDS</strong><br>
                    <small>FOOTBALL CLUB</small>
                </span>
            </a>
            <p class="site-footer__slogan">Bóng đá tư duy cho trẻ từ 3 tuổi</p>
        </div>

        <div class="site-footer__col">
            <h3>Về CLB</h3>
            <ul>
                <li><a href="{{ route('method') }}">Phương pháp giáo dục</a></li>
                <li><a href="{{ route('program') }}">Chương trình dạy</a></li>
                <li><a href="{{ route('about') }}">Tầm nhìn &amp; Sứ mệnh</a></li>
                <li><a href="{{ route('about') }}">Phương châm giáo dục</a></li>
                <li><a href="{{ route('about') }}">Giá trị cốt lõi</a></li>
            </ul>
        </div>

        <div class="site-footer__col">
            <h3>Chương trình</h3>
            <ul>
                <li><a href="{{ route('activity.index') }}">Hoạt động &amp; Sự kiện</a></li>
                <li><a href="{{ route('branch.index') }}">Hệ thống cơ sở</a></li>
                <li><a href="{{ route('faq') }}">Dành cho phụ huynh</a></li>
            </ul>
        </div>

        <div class="site-footer__col">
            <h3>Liên hệ</h3>
            <ul class="site-footer__contact">
                @if ($siteSettings['hotline'] ?? null)
                    <li><a href="tel:{{ $siteSettings['hotline'] }}">{{ $siteSettings['hotline'] }} (Zalo CLB)</a></li>
                @endif
                @if ($siteSettings['zalo_contact'] ?? null)
                    <li><a href="tel:{{ $siteSettings['zalo_contact'] }}">{{ $siteSettings['zalo_contact'] }} (Thầy Lập)</a></li>
                @endif
                @if ($siteSettings['address'] ?? null)
                    <li>{{ $siteSettings['address'] }}</li>
                @endif
            </ul>
        </div>

        <div class="site-footer__col site-footer__quick">
            <h3>Đăng ký tư vấn/học thử</h3>
            <form action="{{ route('registration.quick-store') }}" method="POST" class="site-footer__quick-form">
                @csrf
                <input type="text" name="child_name" placeholder="Họ và tên phụ huynh" maxlength="255" required>
                <input type="tel" name="phone" placeholder="Số điện thoại" maxlength="20" required>
                <button type="submit" class="btn btn--accent btn--sm btn--block">Đăng ký ngay</button>
            </form>
        </div>
    </div>

    <div class="site-footer__bottom">
        <div class="container site-footer__bottom-inner">
            <p>&copy; {{ date('Y') }} Alpha Kids Football Club. All rights reserved.</p>

            @if (($siteSettings['facebook_url'] ?? null) || ($siteSettings['tiktok_url'] ?? null) || ($siteSettings['zalo_url'] ?? null))
                <div class="site-footer__social">
                    @if ($siteSettings['facebook_url'] ?? null)
                        <a href="{{ $siteSettings['facebook_url'] }}" target="_blank" rel="noopener" aria-label="Facebook">
                            <svg viewBox="0 0 24 24"><path d="M13.5 21v-7.6h2.55l.38-2.96h-2.93V8.53c0-.86.24-1.44 1.47-1.44h1.57V4.46A21 21 0 0 0 14.6 4.3c-2.13 0-3.59 1.3-3.59 3.68v2.46H8.46v2.96h2.55V21h2.49z"/></svg>
                        </a>
                    @endif
                    @if ($siteSettings['tiktok_url'] ?? null)
                        <a href="{{ $siteSettings['tiktok_url'] }}" target="_blank" rel="noopener" aria-label="TikTok">
                            <svg viewBox="0 0 24 24"><path d="M16.5 3c.4 2.2 1.9 3.7 4.1 3.9v2.9c-1.5 0-2.9-.5-4.1-1.4v6.4a5.3 5.3 0 1 1-5.3-5.3c.3 0 .6 0 .9.1v3a2.3 2.3 0 1 0 1.6 2.2V3h2.8z"/></svg>
                        </a>
                    @endif
                    @if ($siteSettings['zalo_url'] ?? null)
                        <a href="{{ $siteSettings['zalo_url'] }}" target="_blank" rel="noopener" aria-label="Zalo">
                            <svg viewBox="0 0 24 24"><path d="M4 4h16v12.4l-3.2-1.8H4V4zm3 4.5v1.4h4.6V8.5H7zm0 3v1.4h7V11.5H7z"/></svg>
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</footer>