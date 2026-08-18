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

    $pillarCopy = [
        'tournament' =>
            'Sân chơi lớn nhất trong năm, quy tụ học viên từ mọi cơ sở để thi đấu, kết bạn và tự tin thể hiện những gì đã học.',
        'meetup' =>
            'Những trận giao lưu giữa các cơ sở gần nhau, nơi trẻ học cách thích nghi và tôn trọng đối thủ ngoài sân nhà.',
        'family_day' =>
            'Một ngày bóng đá không chỉ dành cho trẻ. Ba mẹ cùng chơi, cùng thử thách, cùng tạo nên một kỷ niệm chung.',
    ];
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

    <section class="section" data-reveal-group>
        <div class="container">
            <div class="section-head reveal">
                <h2>3 trụ cột <span class="hl">hoạt động</span></h2>
                <p>Mỗi trụ cột là một hành trình lặp lại nhiều kỳ trong năm, nơi những gì trẻ <a
                        href="{{ route('method') }}" class="inline-link">rèn luyện mỗi tuần</a> được đưa ra sân thật để
                    thi đấu, giao lưu và trưởng thành.</p>
            </div>

            <div class="pillar-grid">
                @foreach ($pillars as $i => $pillar)
                    @php
                        $category = $pillar['category'];
                        $value = $category->value;
                        $highlight = $pillar['highlight'];
                    @endphp
                    <div
                        class="pillar-card @if ($highlight) pillar-card--live @endif reveal reveal-d{{ $i + 1 }}">
                        <div class="icon-roundel">{!! $categoryIcons[$value] !!}</div>
                        <h3>{{ $value === 'family_day' ? 'Alpha Together' : $category->getLabel() . ' Alpha Kids' }}</h3>
                        <p>{{ $pillarCopy[$value] }}</p>

                        @if ($highlight)
                            <div class="pillar-card__media">
                                @if ($highlight->image)
                                    <img src="{{ asset('storage/' . $highlight->image) }}" alt="{{ $highlight->name }}"
                                        loading="lazy">
                                @endif
                            </div>
                            <div class="pillar-card__foot">
                                <button type="button" class="pillar-card__link" data-goto-category="{{ $value }}"
                                    data-goto-label="{{ $category->getLabel() }}">
                                    Xem các kỳ đã qua
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4">
                                        <path d="M5 12h14M13 6l6 6-6 6" />
                                    </svg>
                                </button>
                            </div>
                        @else
                            <span class="badge-soon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="9" />
                                    <path d="M12 7v5l3 3" />
                                </svg>
                                Sắp ra mắt
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section--alt" id="archive" data-reveal-group>
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
                        <div class="activity-card" data-category="{{ $activity->category->value }}">
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
                        </div>
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
