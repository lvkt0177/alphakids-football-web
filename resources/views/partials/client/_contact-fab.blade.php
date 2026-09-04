@php
    $fabZaloUrl = $siteSettings['zalo_url'] ?? null;
    $fabHotline = $siteSettings['hotline'] ?? null;
@endphp

@if ($fabZaloUrl || $fabHotline)
    <div class="contact-fab" data-contact-fab>
        <div class="contact-fab__options" data-contact-fab-options>
            @if ($fabZaloUrl)
                <a href="{{ $fabZaloUrl }}" target="_blank" rel="noopener" class="contact-fab__option"
                    aria-label="Chat Zalo">
                    <span class="contact-fab__option-text">Zalo</span>
                </a>
            @endif
            @if ($fabHotline)
                <a href="tel:{{ $fabHotline }}" class="contact-fab__option" aria-label="Gọi điện thoại">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path
                            d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.6 21 3 13.4 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.4 0 .8-.2 1L6.6 10.8z" />
                    </svg>
                </a>
            @endif
        </div>
        <button type="button" class="contact-fab__trigger" data-contact-fab-trigger aria-expanded="false"
            aria-label="Liên hệ nhanh">
            <svg class="contact-fab__icon contact-fab__icon--open" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="1.8">
                <path d="M21 11.5a8.5 8.5 0 0 1-11.9 7.8L4 21l1.7-5.1A8.5 8.5 0 1 1 21 11.5Z" />
            </svg>
            <svg class="contact-fab__icon contact-fab__icon--close" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                <path d="M6 6l12 12M18 6L6 18" />
            </svg>
        </button>
    </div>
@endif
