@php
    $siteSettings = $siteSettings ?? collect();
@endphp

<footer class="site-footer">
    <div class="site-footer__top container">
        <div class="site-footer__col">
            <a href="{{ route('home') }}" class="site-footer__logo">
                <img src="{{ asset('images/logo/logo-website.png') }}" alt="Alpha Kids Football Club">
                <span>
                    <strong>ALPHA KIDS</strong>
                    <small>FOOTBALL CLUB</small>
                    <em class="site-footer__tagline">Bóng đá tư duy</em>
                </span>
            </a>
            <p class="site-footer__intro">
                Alpha Kids Football Club sử dụng bóng đá như một công cụ giáo dục để giúp trẻ phát triển thể chất, tư duy,
                kỹ năng sống và những phẩm chất cần thiết cho tương lai.
            </p>

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
                        <a href="{{ $siteSettings['zalo_url'] }}" target="_blank" rel="noopener" aria-label="Zalo" class="is-text">Zalo</a>
                    @endif
                </div>
            @endif
        </div>

        <div class="site-footer__col">
            <h3>Về CLB</h3>
            <ul class="site-footer__links">
                <li><a href="{{ route('method') }}">Phương pháp giáo dục</a></li>
                <li><a href="{{ route('program') }}">Chương trình dạy</a></li>
                <li><a href="{{ route('about') }}#visionMission">Tầm nhìn &amp; Sứ mệnh</a></li>
                <li><a href="{{ route('about') }}#pillarBento">Mô hình 4 tư duy</a></li>
            </ul>
        </div>

        <div class="site-footer__col">
            <h3>Chương trình</h3>
            <ul class="site-footer__links">
                <li><a href="{{ route('activity.index') }}">Hoạt động &amp; Sự kiện</a></li>
                <li><a href="{{ route('branch.index') }}">Hệ thống cơ sở</a></li>
                <li><a href="{{ route('faq') }}">Câu hỏi thường gặp</a></li>
            </ul>
        </div>

        <div class="site-footer__col">
            <h3>Liên hệ</h3>
            <ul class="site-footer__contact" id="footerContactInfo">
                @if ($siteSettings['hotline'] ?? null)
                    <li id="footerHotline1">
                        <svg viewBox="0 0 24 24"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.6 21 3 13.4 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.4 0 .8-.2 1L6.6 10.8z"/></svg>
                        <a href="tel:{{ $siteSettings['hotline'] }}">{{ $siteSettings['hotline'] }} (Zalo CLB)</a>
                    </li>
                @endif
                @if ($siteSettings['zalo_contact'] ?? null)
                    <li id="footerHotline2">
                        <svg viewBox="0 0 24 24"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.6 21 3 13.4 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.4 0 .8-.2 1L6.6 10.8z"/></svg>
                        <a href="tel:{{ $siteSettings['zalo_contact'] }}">{{ $siteSettings['zalo_contact'] }} (Thầy Lập)</a>
                    </li>
                @endif
                @if ($siteSettings['email'] ?? null)
                    <li id="footerEmail">
                        <svg viewBox="0 0 24 24"><path d="M4 4h16a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1zm16 3.2-8 5.6-8-5.6V18h16V7.2zM4.4 6l7.6 5.3L19.6 6H4.4z"/></svg>
                        <a href="mailto:{{ $siteSettings['email'] }}">{{ $siteSettings['email'] }}</a>
                    </li>
                @endif
                @if ($siteSettings['address'] ?? null)
                    <li id="footerAddress">
                        <svg viewBox="0 0 24 24"><path d="M12 2a7 7 0 0 0-7 7c0 5.2 7 13 7 13s7-7.8 7-13a7 7 0 0 0-7-7zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5z"/></svg>
                        <span>{{ $siteSettings['address'] }}</span>
                    </li>
                @endif
            </ul>

            <div class="site-footer__quick" id="siteFooterQuick">
                <h4>Đăng ký tư vấn / học thử</h4>
                <p>Để lại thông tin để được tư vấn miễn phí</p>
                <form action="{{ route('registration.quick-store') }}" method="POST" class="site-footer__quick-form">
                    @csrf
                    <input type="text" name="child_name" placeholder="Họ tên" maxlength="255" required>
                    <input type="tel" name="phone" placeholder="Số điện thoại" maxlength="20" required>
                    <button type="submit" class="btn btn--accent btn--sm btn--block">
                        Đăng ký ngay
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="site-footer__bottom">
        <div class="container site-footer__bottom-inner">
            <p>&copy; {{ date('Y') }} Alpha Kids Football Club. All rights reserved.</p>
        </div>
    </div>
</footer>