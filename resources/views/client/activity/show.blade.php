@extends('layouts.client', [
    'title' => $activity->name . ' | Hoạt động & Sự kiện Alpha Kids',
    'description' => \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($activity->description ?? ''))), 150)
        ?: 'Xem lại khoảnh khắc ' . $activity->name . ' tại Alpha Kids Football Club.',
    'ogImage' => $ogImage,
])

@push('styles')
    <link rel="stylesheet"
        href="{{ asset('css/client/activity-show.css') }}?v={{ filemtime(public_path('css/client/activity-show.css')) }}">
@endpush

@php
    $categoryIcons = [
        'tournament' =>
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M8 21h8M12 17v4M6 4h12v3a6 6 0 0 1-12 0V4z" /><path d="M6 6H3a3 3 0 0 0 3 4M18 6h3a3 3 0 0 1-3 4" /></svg>',
        'meetup' =>
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M8 12l2.5 2.5L15 10" /><path d="M2 11l4.5-4.5a2 2 0 0 1 2.8 0L11 8M22 11l-4.5-4.5a2 2 0 0 0-2.8 0L13 8" /><path d="M2 11v3a2 2 0 0 0 2 2h1M22 11v3a2 2 0 0 1-2 2h-1" /></svg>',
        'family_day' =>
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="9" cy="7" r="2.6" /><circle cx="17" cy="8.5" r="2" /><path d="M3.5 20c0-3.3 2.5-6 5.5-6s5.5 2.7 5.5 6M15 20c0-2.4-.9-4.5-2.3-5.6a4.2 4.2 0 0 1 5.8 1.1c.6.9 1 2.4 1 4.5" /></svg>',
    ];

    $emptyMediaIcon =
        '<svg viewBox="0 0 24 24" fill="none" stroke="var(--ink-soft)" stroke-width="1.2" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2" /><circle cx="9" cy="10" r="2" /><path d="M3 17l5-4 4 3 4-5 5 6" /></svg>';

    $heroTeaser = $activity->description
        ? \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($activity->description))), 130)
        : null;
@endphp

@section('content')
    <section class="show-hero" data-reveal-group>
        <div class="show-hero__media">
            @if ($activity->image)
                <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->name }}">
            @else
                <div class="show-hero__media-empty">{!! $emptyMediaIcon !!}</div>
            @endif
        </div>
        <div class="show-hero__info reveal">
            <span class="show-hero__tag">{!! $categoryIcons[$activity->category->value] !!} {{ $activity->category->getLabel() }}</span>
            <h1>{{ $activity->name }}</h1>
            @if ($heroTeaser)
                <p class="show-hero__desc">{{ $heroTeaser }}</p>
            @endif
            @if ($activity->images->isNotEmpty())
                <div class="show-hero__meta">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2" /><circle cx="8.5" cy="10" r="1.5" /><path d="M21 15l-5-5-4 4-2-2-5 5" /></svg>
                    <span>{{ $activity->images->count() }} ảnh</span>
                </div>
            @endif
        </div>
    </section>

    <section class="show-gallery-section" data-reveal-group>
        <div class="container">
            <div class="show-gallery-head reveal">
                <h2>Khoảnh khắc</h2>
                <span>{{ $activity->images->count() }} ảnh</span>
            </div>

            @if ($activity->images->isNotEmpty())
                <div class="show-gallery" id="showGallery">
                    @foreach ($activity->images as $i => $image)
                        <figure>
                            <img loading="lazy" src="{{ asset('storage/' . $image->image) }}"
                                alt="{{ $image->alt_text ?: $activity->name . ' - ảnh ' . ($i + 1) }}">
                        </figure>
                    @endforeach
                </div>
            @else
                <div class="show-gallery-empty">Hoạt động này chưa có ảnh trong thư viện.</div>
            @endif
        </div>
    </section>

    <section class="closing-cta" data-reveal-group>
        @if ($closingCtaPhoto)
            <img class="closing-cta__photo" src="{{ asset('storage/' . $closingCtaPhoto) }}"
                alt="" loading="lazy">
        @endif
        <div class="closing-cta__scrim" aria-hidden="true"></div>
        <div class="container closing-cta__inner reveal">
            <h2>Đồng hành cùng con trên <span class="text-accent-free">mỗi chặng đường</span> trưởng thành</h2>
            <p class="closing-cta__note">Hãy để con bạn tham gia các hoạt động bổ ích tại Alpha Kids để phát triển toàn diện
                cả về thể chất, tư duy và nhân cách.</p>
            <div class="closing-cta__actions">
                <a href="{{ route('registration.create') }}" class="btn btn--accent">Đăng ký học thử ngay</a>
            </div>
        </div>
    </section>

    <div class="show-lightbox" id="showLightbox">
        <button class="show-lightbox__close" id="showLbClose" type="button">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M6 6l12 12M18 6L6 18" /></svg>
        </button>
        <button class="show-lightbox__nav show-lightbox__nav--prev" id="showLbPrev" type="button">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M15 6l-6 6 6 6" /></svg>
        </button>
        <img id="showLbImage" src="" alt="">
        <button class="show-lightbox__nav show-lightbox__nav--next" id="showLbNext" type="button">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M9 6l6 6-6 6" /></svg>
        </button>
        <div class="show-lightbox__count" id="showLbCount"></div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/client/activity-show.js') }}?v={{ filemtime(public_path('js/client/activity-show.js')) }}"
        defer></script>
@endpush
