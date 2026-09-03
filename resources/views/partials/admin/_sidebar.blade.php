<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <img src="{{ asset('images/logo/logo-website.png') }}" alt="Alpha Kids Football">
        </div>
        <div>
            <div class="sidebar-title">Alpha Kids Football</div>
            <div class="sidebar-subtitle">Quản trị website</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}"
            class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9" rx="1.5"/><rect x="14" y="3" width="7" height="5" rx="1.5"/><rect x="14" y="12" width="7" height="9" rx="1.5"/><rect x="3" y="16" width="7" height="5" rx="1.5"/></svg>
            </span>
            Tổng quan
        </a>

        <div class="sidebar-nav-group-label">Nội dung website</div>
        <a href="{{ route('admin.setting.home') }}"
            class="nav-item {{ request()->routeIs('admin.setting.home') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11.5 12 4l9 7.5"/><path d="M5 10v9a1 1 0 0 0 1 1h4v-6h4v6h4a1 1 0 0 0 1-1v-9"/></svg>
            </span>
            Nội dung Trang chủ
        </a>
        <a href="{{ route('admin.setting.other-pages') }}"
            class="nav-item {{ request()->routeIs('admin.setting.other-pages') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18"/><path d="M8 4v5"/></svg>
            </span>
            Nội dung Trang khác
        </a>
        <a href="{{ route('admin.setting.general') }}"
            class="nav-item {{ request()->routeIs('admin.setting.general') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 11v6"/><path d="M12 7.5h.01"/></svg>
            </span>
            Thông tin chung
        </a>

        <div class="sidebar-nav-group-label">Vận hành</div>
        <a href="{{ route('admin.branch.index') }}"
            class="nav-item {{ request()->routeIs('admin.branch.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.1-7-11.5A7 7 0 0 1 19 9.5C19 14.9 12 21 12 21Z"/><circle cx="12" cy="9.5" r="2.4"/></svg>
            </span>
            Hệ thống cơ sở
        </a>
        <a href="{{ route('admin.activity.index') }}"
            class="nav-item {{ request()->routeIs('admin.activity.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 3v3M12 18v3M3 12h3M18 12h3"/><circle cx="12" cy="12" r="3"/></svg>
            </span>
            Hoạt động &amp; Sự kiện
        </a>
        <a href="{{ route('admin.registration.index') }}"
            class="nav-item {{ request()->routeIs('admin.registration.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3.5" y="4" width="17" height="16" rx="2"/><path d="M7.5 9h9M7.5 13h9M7.5 17h5"/></svg>
            </span>
            Đăng ký học thử
        </a>
        <a href="{{ route('admin.proof-point.index') }}"
            class="nav-item {{ request()->routeIs('admin.proof-point.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M7 8h10M7 12h6M4 4h16v11H9l-5 4V4z"/></svg>
            </span>
            Vì sao chọn Alpha Kids
        </a>
        <a href="{{ route('admin.faq.index') }}"
            class="nav-item {{ request()->routeIs('admin.faq.*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M9.5 9a2.5 2.5 0 0 1 5 0c0 1.5-2 2-2 3.5"/><path d="M12 17h.01"/></svg>
            </span>
            Câu hỏi thường gặp
        </a>
    </nav>

    <a href="{{ route('admin.account.edit') }}" class="sidebar-footer {{ request()->routeIs('admin.account.*') ? 'active' : '' }}">
        <div class="sidebar-footer-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
        <div class="sidebar-footer-text">
            <div class="sidebar-footer-name">{{ auth()->user()->name ?? 'Quản trị viên' }}</div>
            <div class="sidebar-footer-email">{{ auth()->user()->email ?? 'admin@alphakidsfootball.vn' }}</div>
        </div>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" width="15" height="15" style="flex-shrink:0;color:var(--text-muted);"><rect x="4.5" y="10.5" width="15" height="9.5" rx="2"/><path d="M8 10.5V7.5a4 4 0 0 1 8 0v3"/></svg>
    </a>
</aside>