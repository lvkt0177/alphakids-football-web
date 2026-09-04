<header class="topbar">
    <button class="icon-btn" id="hamburger" aria-label="Mở menu">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
    </button>
    <div style="flex:1;min-width:0;">
        <h1>@yield('page-title', 'Admin')</h1>
        <div class="topbar-desc">@yield('page-desc', '')</div>
    </div>
    <div class="topbar-actions">
        <a href="{{ url('/') }}" target="_blank" rel="noopener" class="topbar-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h6"/><path d="M15 3h6v6"/><path d="M10 14 21 3"/></svg>
            Xem website
        </a>
        <div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="icon-btn" aria-label="Đăng xuất" title="Đăng xuất">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
            </button>
        </form>
    </div>
</header>