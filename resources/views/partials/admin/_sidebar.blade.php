<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">AK</div>
        <div>
            <div class="sidebar-title">Alpha Kids Football</div>
            <div class="sidebar-subtitle">Quản trị website</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}"
            class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            Tổng quan
        </a>
        <a href="{{ route('admin.setting.home') }}"
            class="nav-item {{ request()->routeIs('admin.setting.home') ? 'active' : '' }}">
            Nội dung Trang chủ
        </a>
        <a href="{{ route('admin.setting.general') }}"
            class="nav-item {{ request()->routeIs('admin.setting.general') ? 'active' : '' }}">
            Thông tin chung
        </a>
        <a href="{{ route('admin.branch.index') }}"
            class="nav-item {{ request()->routeIs('admin.branch.*') ? 'active' : '' }}">
            Hệ thống cơ sở
        </a>
        <a href="{{ route('admin.activity.index') }}"
            class="nav-item {{ request()->routeIs('admin.activity.*') ? 'active' : '' }}">
            Hoạt động & Sự kiện
        </a>
        <a href="{{ route('admin.registration.index') }}"
            class="nav-item {{ request()->routeIs('admin.registration.*') ? 'active' : '' }}">
            Đăng ký học thử
        </a>
    </nav>

    <div class="sidebar-footer">
        Đăng nhập: admin@alphakidsfootball.vn
    </div>
</aside>
