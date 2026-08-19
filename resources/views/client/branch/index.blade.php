@extends('layouts.client', [
    'title' => 'Hệ thống cơ sở',
    'description' => 'Danh sách các cơ sở Alpha Kids Football Club, địa chỉ, lịch học và bản đồ để phụ huynh tìm cơ sở gần nhất.',
    'ogImage' => $ogImage,
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/client/branch.css') }}?v={{ filemtime(public_path('css/client/branch.css')) }}">
@endpush

@php
    $statItems = [
        [
            'label' => 'Vị trí thuận tiện',
            'sub' => 'Dễ dàng di chuyển',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 21s-7-6.1-7-11.5A7 7 0 0 1 19 9.5C19 14.9 12 21 12 21Z" /><circle cx="12" cy="9.5" r="2.4" /></svg>',
        ],
        [
            'label' => 'Sân bãi đạt chuẩn',
            'sub' => 'An toàn, chất lượng',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="7" width="18" height="10" rx="1" /><path d="M3 12h18M9 7v10M15 7v10" /></svg>',
        ],
        [
            'label' => 'Lịch học linh hoạt',
            'sub' => 'Nhiều khung giờ',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="9" /><path d="M12 7v5l3 3" /></svg>',
        ],
        [
            'label' => 'Môi trường chuẩn CLB',
            'sub' => 'Chuyên nghiệp, tích cực',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6z" /><path d="M9 12l2 2 4-4.5" /></svg>',
        ],
    ];

    $emptyMediaIcon = '<svg viewBox="0 0 24 24" fill="none" stroke="var(--ink)" stroke-width="1.4" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2" /><circle cx="9" cy="10" r="2" /><path d="M3 17l5-4 4 3 4-5 5 6" /></svg>';
@endphp

@section('content')
    <section class="page-hero @if ($images['branch_banner'] ?? null) page-hero--photo @endif">
        @if ($images['branch_banner'] ?? null)
            <div class="page-hero__photo" aria-hidden="true">
                <img src="{{ asset('storage/' . $images['branch_banner']) }}" alt="">
            </div>
            <div class="page-hero__scrim" aria-hidden="true"></div>
        @endif
        <div class="container">
            <h1>Hệ thống cơ sở <span class="hl">hiện đại gần bạn</span></h1>
            <p>Alpha Kids Football Club hiện có nhiều cơ sở tập luyện tại các khu vực thuận tiện, giúp phụ huynh dễ dàng lựa chọn địa điểm phù hợp nhất cho con.</p>
        </div>
    </section>

    <div class="stat-wrap container" data-reveal-group>
        <div class="stat-bar reveal">
            @foreach ($statItems as $item)
                <div class="stat-item">
                    <div class="icon-roundel">{!! $item['icon'] !!}</div>
                    <div>
                        <div class="stat-item__label">{{ $item['label'] }}</div>
                        <div class="stat-item__sub">{{ $item['sub'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <section class="section" data-reveal-group>
        <div class="container">
            <div class="section-head reveal">
                <h2>Các cơ sở <span class="hl">đang hoạt động</span></h2>
                <p>Chọn cơ sở gần bạn nhất để xem lịch học và đăng ký học thử.</p>
            </div>

            @if ($branches->isNotEmpty())
                <div class="branch-rows">
                    @foreach ($branches as $branch)
                        <div class="branch-row reveal reveal-d1">
                            <div class="branch-row__media">
                                @if ($branch->image)
                                    <img src="{{ asset('storage/' . $branch->image) }}" alt="{{ $branch->name }}" loading="lazy">
                                @else
                                    <div class="branch-row__media-empty">{!! $emptyMediaIcon !!}<span>Chưa có ảnh</span></div>
                                @endif
                            </div>

                            <div class="branch-row__body">
                                <div>
                                    @if ($branch->location)
                                        <h3 class="branch-row__title"><span class="branch-row__title-index">Cơ sở {{ $loop->iteration }}:</span> {{ $branch->displayLocation() }}</h3>
                                        <div class="branch-row__name">{{ $branch->name }}</div>
                                    @else
                                        <h3 class="branch-row__title">{{ $branch->name }}</h3>
                                    @endif
                                </div>
                                <div class="branch-row__address">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 21s-7-6.1-7-11.5A7 7 0 0 1 19 9.5C19 14.9 12 21 12 21Z" /><circle cx="12" cy="9.5" r="2.4" /></svg>
                                    <span>{{ $branch->address }}</span>
                                </div>

                                @if ($branch->description)
                                    <p class="branch-row__desc">{{ $branch->description }}</p>
                                @endif

                                @php $scheduleByDay = $branch->scheduleByDay(); @endphp
                                @if (! empty($scheduleByDay))
                                    <div>
                                        <div class="schedule-label">Lịch học</div>
                                        <div class="schedule-chips">
                                            @foreach ($scheduleByDay as $entry)
                                                <div class="schedule-chip">
                                                    <div class="schedule-chip__day">{{ $entry['day'] }}</div>
                                                    <div class="schedule-chip__time">
                                                        @foreach ($entry['times'] as $time)
                                                            <div class="schedule-chip__slot">
                                                                {{ $time['start'] }}–{{ $time['end'] }}
                                                                @if ($time['level'])
                                                                    <span class="schedule-chip__level">({{ $time['level'] }})</span>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="branch-row__actions">
                                    @if ($branch->mapsSearchUrl())
                                        <a href="{{ $branch->mapsSearchUrl() }}" target="_blank" rel="noopener" class="btn btn--outline btn--sm">Xem trên bản đồ</a>
                                    @endif
                                    <a href="{{ route('registration.create', ['branch' => $branch->id]) }}" class="btn btn--accent btn--sm">Đăng ký học thử</a>
                                </div>
                            </div>

                            @if ($branch->map_embed_url)
                                <div class="branch-row__map">
                                    <iframe src="{{ $branch->map_embed_url }}" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Bản đồ {{ $branch->location ?: $branch->name }}"></iframe>
                                </div>
                            @else
                                <div class="branch-row__map branch-row__map-empty">
                                    {!! $emptyMediaIcon !!}
                                    <span>Chưa cấu hình bản đồ nhúng</span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="activities__empty">Hệ thống cơ sở đang được cập nhật, vào Admin để thêm cơ sở hiển thị tại đây.</div>
            @endif
        </div>
    </section>

    <section class="closing-cta" data-reveal-group>
        @if ($images['branch_closing_cta_photo'] ?? null)
            <img class="closing-cta__photo" src="{{ asset('storage/' . $images['branch_closing_cta_photo']) }}" alt="" loading="lazy">
        @endif
        <div class="closing-cta__scrim" aria-hidden="true"></div>
        <div class="container closing-cta__inner reveal">
            <h2>Chọn cơ sở gần nhất, <span class="text-accent-free">đăng ký học thử ngay</span></h2>
            <p class="closing-cta__note">Để con trải nghiệm môi trường tập luyện chuyên nghiệp, phát triển toàn diện cả về thể chất, tư duy và kỹ năng sống.</p>
            <div class="closing-cta__actions">
                <a href="{{ route('registration.create') }}" class="btn btn--accent">Đăng ký học thử miễn phí</a>
            </div>
        </div>
    </section>

    @if ($branches->isNotEmpty())
        <script type="application/ld+json">
            {!! json_encode([
                '@@context' => 'https://schema.org',
                '@graph' => $branches->map(fn ($branch) => $branch->structuredData())->all(),
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
        </script>
    @endif
@endsection
