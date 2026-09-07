@extends('layouts.client', [
    'title' => 'Hoạt động & Sự kiện',
    'description' => 'Giải đấu, giao lưu và những ngày Alpha Together tại Alpha Kids Football Club - nơi trẻ thi đấu, kết bạn và trưởng thành cùng gia đình.',
    'ogImage' => $ogImage,
])

@push('styles')
    <link rel="stylesheet"
        href="{{ asset('css/client/activity.css') }}?v={{ filemtime(public_path('css/client/activity.css')) }}">
@endpush

@php
    use App\Enums\ActivityCategory;

    $categoryIcons = [
        'tournament' =>
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M8 21h8M12 17v4M6 4h12v3a6 6 0 0 1-12 0V4z" /><path d="M6 6H3a3 3 0 0 0 3 4M18 6h3a3 3 0 0 1-3 4" /></svg>',
        'meetup' =>
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M8 12l2.5 2.5L15 10" /><path d="M2 11l4.5-4.5a2 2 0 0 1 2.8 0L11 8M22 11l-4.5-4.5a2 2 0 0 0-2.8 0L13 8" /><path d="M2 11v3a2 2 0 0 0 2 2h1M22 11v3a2 2 0 0 1-2 2h-1" /></svg>',
        'family_day' =>
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="9" cy="7" r="2.6" /><circle cx="17" cy="8.5" r="2" /><path d="M3.5 20c0-3.3 2.5-6 5.5-6s5.5 2.7 5.5 6M15 20c0-2.4-.9-4.5-2.3-5.6a4.2 4.2 0 0 1 5.8 1.1c.6.9 1 2.4 1 4.5" /></svg>',
    ];

    $allIcon =
        '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1.5" /><rect x="14" y="3" width="7" height="7" rx="1.5" /><rect x="3" y="14" width="7" height="7" rx="1.5" /><rect x="14" y="14" width="7" height="7" rx="1.5" /></svg>';

    $emptyMediaIcon =
        '<svg viewBox="0 0 24 24" fill="none" stroke="var(--ink)" stroke-width="1.4" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2" /><circle cx="9" cy="10" r="2" /><path d="M3 17l5-4 4 3 4-5 5 6" /></svg>';
@endphp

@section('content')
    <section class="page-hero @if ($images['activity_banner'] ?? null) page-hero--photo @endif">
        @if ($images['activity_banner'] ?? null)
            <div class="page-hero__photo" aria-hidden="true">
                <img src="{{ asset('storage/' . $images['activity_banner']) }}" alt="">
            </div>
            <div class="page-hero__scrim" aria-hidden="true"></div>
        @endif
        <div class="container">
            <h1>Hoạt động &amp; Sự kiện <span class="hl">Alpha Kids</span></h1>
            <p>Trải nghiệm, kết nối và trưởng thành qua giải đấu, giao lưu và những ngày Alpha Together bên gia đình.</p>
        </div>
    </section>

    <section class="section" id="archive" data-reveal-group>
        <div class="container">
            <div class="archive-toolbar reveal">
                <div class="section-head" style="margin-bottom:0">
                    <h2>Các kỳ đã và sắp diễn ra</h2>
                    <p>Lọc theo hạng mục để xem nhanh những kỳ bạn quan tâm.</p>
                </div>
                <span class="archive-toolbar__count">Đang lọc: <b id="filterLabel">Tất cả</b> · <span
                        id="filterCount">{{ $activities->count() }}</span> hoạt động</span>
            </div>

            <div class="archive-filter-bar reveal" id="archiveFilterBar">
                <button type="button" class="archive-filter-chip is-active" data-category="all">
                    <span class="archive-filter-chip__icon">{!! $allIcon !!}</span>
                    <span>Tất cả</span>
                </button>
                @foreach (['tournament', 'meetup', 'family_day'] as $categoryValue)
                    <button type="button" class="archive-filter-chip" data-category="{{ $categoryValue }}">
                        <span class="archive-filter-chip__icon">{!! $categoryIcons[$categoryValue] !!}</span>
                        <span>{{ ActivityCategory::from($categoryValue)->getLabel() }}</span>
                    </button>
                @endforeach
            </div>

            @if ($activities->isNotEmpty())
                <div class="activity-grid reveal reveal-d1">
                    @foreach ($activities as $activity)
                        <a class="activity-card" href="{{ route('activity.show', $activity) }}"
                            data-category="{{ $activity->category->value }}">
                            @if ($activity->image)
                                <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->name }}"
                                    loading="lazy">
                            @else
                                <div class="activity-card__media-empty">{!! $emptyMediaIcon !!}</div>
                            @endif
                            <div class="activity-card__overlay">
                                <span class="activity-card__tag">{{ $activity->category->getLabel() }}</span>
                                <h3>{{ $activity->name }}</h3>
                                @if ($activity->description)
                                    <p class="activity-card__desc">
                                        {{ \Illuminate\Support\Str::limit($activity->description, 90) }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach

                    <div class="activities__empty archive-empty" id="archiveEmpty">
                        Chưa có hoạt động nào ở hạng mục này. Alpha Kids sẽ cập nhật ngay khi có lịch chính thức.
                    </div>
                </div>
            @else
                <div class="activities__empty">Hoạt động đang được cập nhật, vào Admin để thêm hoạt động hiển thị tại đây.
                </div>
            @endif
        </div>
    </section>

    <section class="closing-cta" data-reveal-group>
        @if ($images['activity_closing_cta_photo'] ?? null)
            <img class="closing-cta__photo" src="{{ asset('storage/' . $images['activity_closing_cta_photo']) }}"
                alt="" loading="lazy">
        @endif
        <div class="closing-cta__scrim" aria-hidden="true"></div>
        <div class="container closing-cta__inner reveal">
            <h2>Đồng hành cùng con trên <span class="text-accent-free">mỗi chặng đường</span> trưởng thành</h2>
            <p class="closing-cta__note">Hãy để con bạn tham gia các hoạt động bổ ích tại Alpha Kids để phát triển toàn diện
                cả về thể chất, tư duy và nhân cách.</p>
            <div class="closing-cta__actions">
                <a href="{{ route('registration.create') }}" class="btn btn--accent">Đăng ký học thử ngay</a>
                <a href="{{ route('branch.index') }}" class="btn btn--outline-invert">Xem cơ sở gần bạn</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/client/activity.js') }}?v={{ filemtime(public_path('js/client/activity.js')) }}" defer>
    </script>
@endpush
