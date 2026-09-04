@extends('layouts.client', [
    'title' => 'Chương trình dạy',
    'description' => 'Lộ trình huấn luyện bóng đá tư duy 12 tháng, cấu trúc buổi học 3 khối, chương trình theo độ tuổi 3-14. Đăng ký học thử miễn phí tại Alpha Kids Football Club.',
    'ogImage' => $ogImage,
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/client/program.css') }}?v={{ filemtime(public_path('css/client/program.css')) }}">
@endpush

@php
    $roadmap = [
        [
            'months' => 'Tháng 1 & Tháng 7',
            'topic' => 'Chuyền & kiểm soát bóng',
            'desc' => 'Mọi hành trình bóng đá đều bắt đầu từ việc làm chủ trái bóng. Trẻ được rèn chuyền bằng cả hai chân, giữ bóng ổn định trong không gian hẹp và cảm nhận lực chạm bóng tinh tế, nền tảng cho mọi kỹ thuật nâng cao sau này.',
            'image_key' => 'program_roadmap_1',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="9" /><path d="M12 7.8l3.4 2.5-1.3 4h-4.2l-1.3-4z" /><path d="M12 7.8V4.2M15.4 10.3l3.2-1.7M14.1 14.3l2.3 3M9.9 14.3l-2.3 3M8.6 10.3l-3.2-1.7" /></svg>',
        ],
        [
            'months' => 'Tháng 2 & Tháng 8',
            'topic' => 'Dẫn bóng & qua người',
            'desc' => 'Từ việc giữ bóng vững, trẻ học cách di chuyển cùng bóng qua các tình huống 1 đối 1. Bài tập nhấn mạnh sự tự tin khi đối mặt đối thủ, phản xạ nhanh và khả năng đọc không gian trống để vượt qua đối phương một cách khéo léo.',
            'image_key' => 'program_roadmap_2',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 18c3-7 5 7 8 0s5-7 8 0" /><circle cx="19.5" cy="7" r="1.8" fill="currentColor" stroke="none" /></svg>',
        ],
        [
            'months' => 'Tháng 3 & Tháng 9',
            'topic' => 'Sút bóng & tấn công',
            'desc' => 'Biết giữ bóng, biết qua người, giờ là lúc dứt điểm. Trẻ luyện lực sút, độ chính xác và quan trọng nhất là thời điểm ra chân, kết hợp cùng tư duy tấn công để biến cơ hội thành bàn thắng.',
            'image_key' => 'program_roadmap_3',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M5 20V6h14v14" /><path d="M5 6h14" /><path d="M9 11l4-3 3 1.5" /></svg>',
        ],
        [
            'months' => 'Tháng 4 & Tháng 10',
            'topic' => 'Phòng ngự & tranh chấp',
            'desc' => 'Bóng đá không chỉ có tấn công. Trẻ học cách đọc tình huống, chọn vị trí phòng ngự hợp lý và tranh chấp bóng đúng luật, an toàn, hình thành tinh thần trách nhiệm với cả đội, không chỉ riêng bản thân.',
            'image_key' => 'program_roadmap_4',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6z" /></svg>',
        ],
        [
            'months' => 'Tháng 5 & Tháng 11',
            'topic' => 'Di chuyển & tổ chức',
            'desc' => 'Một cầu thủ giỏi không chỉ giỏi khi có bóng. Trẻ được rèn cách di chuyển thông minh, chọn vị trí đón bóng và phối hợp nhịp nhàng với đồng đội, nền tảng của tư duy chiến thuật và tinh thần đồng đội thực thụ.',
            'image_key' => 'program_roadmap_5',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="13.5" cy="4.5" r="1.8" fill="currentColor" stroke="none" /><path d="M13 7l-1.5 4.5 3 2 1 6.5M11.5 11.5l-4.5 2M14 13l3.5 1 2 5.5M8.5 21.5l2.5-4.5" /></svg>',
        ],
        [
            'months' => 'Tháng 6 & Tháng 12',
            'topic' => 'Tổng hợp & đánh giá',
            'desc' => 'Khép lại mỗi chu kỳ 6 tháng là lúc tổng hợp toàn bộ kỹ năng đã học vào các trận đấu thực tế. HLV đánh giá sự tiến bộ của từng trẻ, ghi nhận điểm mạnh và định hướng rõ ràng cho chu kỳ tiếp theo.',
            'image_key' => 'program_roadmap_6',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M9 4h6a1 1 0 0 1 1 1v1.5H8V5a1 1 0 0 1 1-1z" /><rect x="6" y="6" width="12" height="15" rx="1.5" /><path d="M9 13.5l2 2 4-4.5" /></svg>',
        ],
    ];

    $sessionBlocks = [
        [
            'duration' => 10,
            'label' => 'Khởi động',
            'desc' => 'Làm nóng cơ thể, tăng sự linh hoạt và hứng thú trước buổi tập.',
            'image_key' => 'program_structure_warmup',
        ],
        [
            'duration' => 45,
            'label' => 'Kỹ thuật & chủ đề tháng',
            'desc' => '3 bài tập thực hành kỹ thuật theo chủ đề tháng, từ cơ bản đến nâng cao.',
            'image_key' => 'program_structure_technique',
        ],
        [
            'duration' => 30,
            'label' => 'Thi đấu ứng dụng',
            'desc' => 'Áp dụng kỹ năng vào thi đấu, phối hợp cùng đồng đội trên sân.',
            'image_key' => 'program_structure_match',
        ],
    ];

    $ageCards = [
        [
            'age' => '3 – 6 tuổi',
            'name' => 'Mầm non',
            'desc' => 'Ưu tiên phát triển vận động, sự tự tin và kỹ năng xã hội qua trò chơi bóng đá.',
            'points' => [
                'Làm quen bóng qua trò chơi nhóm',
                'Xây dựng tư duy giao tiếp',
                'Vận động cơ bản, phối hợp tay-mắt',
                'Khích lệ đúng lúc theo tinh thần C.A.R.E',
            ],
            'image_key' => 'program_age_toddler',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="8" r="3" /><path d="M5 20c0-3.9 3.1-7 7-7s7 3.1 7 7" /></svg>',
        ],
        [
            'age' => '7 – 10 tuổi',
            'name' => 'Tiểu học',
            'desc' => 'Phát triển kỹ thuật bóng đá cùng tư duy chiến thuật và tinh thần đồng đội.',
            'points' => [
                'Kỹ thuật nền tảng: chuyền, kiểm soát bóng',
                'Rèn tư duy đánh giá bản thân',
                'Thi đấu nhóm nhỏ, học cách ứng xử',
                'Làm quen nhịp độ 3 khối buổi học',
            ],
            'image_key' => 'program_age_primary',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="9" cy="12" r="4" /><circle cx="16" cy="12" r="4" /></svg>',
        ],
        [
            'age' => '11 – 14 tuổi',
            'name' => 'Cấp 2',
            'desc' => 'Nâng cao kỹ thuật, chiến thuật và khả năng lãnh đạo trên sân.',
            'points' => [
                'Chiến thuật thi đấu nâng cao',
                'Phát triển tư duy lãnh đạo đội nhóm',
                'Rèn kỷ luật và tinh thần trách nhiệm',
                'Chuẩn bị tâm lý thi đấu đối kháng',
            ],
            'image_key' => 'program_age_teen',
            'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M5 3v18" /><path d="M5 4h13l-3 4 3 4H5" /></svg>',
        ],
    ];
@endphp

@section('content')
<div class="program-page">

    <section class="page-hero @if ($images['program_banner'] ?? null) page-hero--photo @endif">
        @if ($images['program_banner'] ?? null)
            <div class="page-hero__photo" aria-hidden="true">
                <img src="{{ asset('storage/' . $images['program_banner']) }}" alt="">
            </div>
            <div class="page-hero__scrim" aria-hidden="true"></div>
        @endif
        <div class="container">
            <h1>Chương trình dạy <span class="hl">khoa học, bài bản</span></h1>
            <p>Chương trình xây dựng theo từng giai đoạn phát triển của trẻ, lặp lại để hình thành thói quen vững chắc.</p>
        </div>
    </section>

    <section class="section section--padding-block-80" data-reveal-group>
        <div class="container">
            <div class="section-head section-head--center reveal">
                <h2>Lộ trình chương trình <span class="hl">12 tháng</span></h2>
                <p>6 chủ đề cốt lõi xuyên suốt năm học, mỗi chủ đề học 2 lần cách nhau 6 tháng để trẻ thực hành đủ sâu, luôn gắn với 4 tư duy trong <a href="{{ route('method') }}" class="inline-link">phương pháp C.A.R.E</a>.</p>
            </div>

            <div class="roadmap-rows">
                @foreach ($roadmap as $i => $node)
                    <div class="roadmap-row @if ($i % 2 === 1) roadmap-row--reverse @endif" data-reveal-group>
                        <div class="roadmap-row__media reveal">
                            @if ($images[$node['image_key']] ?? null)
                                <img src="{{ asset('storage/' . $images[$node['image_key']]) }}" alt="{{ $node['topic'] }} - buổi tập tại Alpha Kids Football Club" loading="lazy">
                            @else
                                <div class="roadmap-row__media-empty">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><rect x="3" y="5" width="18" height="14" rx="2" /><circle cx="9" cy="10.5" r="1.6" /><path d="M21 16l-5.5-5.5L9 17" /></svg>
                                    <span>Chưa có ảnh</span>
                                </div>
                            @endif
                        </div>
                        <div class="roadmap-row__body reveal reveal-d1">
                            <div class="roadmap-row__meta">
                                <div class="roadmap-row__icon">{!! $node['icon'] !!}</div>
                                <span class="roadmap-row__months">{{ $node['months'] }}</span>
                            </div>
                            <h3 class="roadmap-row__topic">{{ $node['topic'] }}</h3>
                            <p class="roadmap-row__desc">{{ $node['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section--alt" data-reveal-group>
        <div class="container">
            <div class="section-head section-head--center reveal">
                <h2>Cấu trúc <span class="hl">mỗi buổi học</span></h2>
                <p>Mỗi buổi học được thiết kế khoa học, cân bằng giữa kỹ thuật, tư duy và cảm xúc.</p>
            </div>

            <div class="session-row reveal reveal-d1">
                @foreach ($sessionBlocks as $i => $block)
                    <div class="session-card">
                        <div class="session-card__head">
                            <div class="session-badge">{{ $block['duration'] }}<small>phút</small></div>
                            <h3>{{ $block['label'] }}</h3>
                        </div>
                        <p>{{ $block['desc'] }}</p>
                        <div class="session-card__media">
                            @if ($images[$block['image_key']] ?? null)
                                <img src="{{ asset('storage/' . $images[$block['image_key']]) }}" alt="{{ $block['label'] }} - khối {{ $block['duration'] }} phút trong buổi tập Alpha Kids" loading="lazy">
                            @else
                                <div class="session-card__media-empty">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><rect x="3" y="5" width="18" height="14" rx="2" /><circle cx="9" cy="10.5" r="1.6" /><path d="M21 16l-5.5-5.5L9 17" /></svg>
                                    <span>Chưa có ảnh</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if (!$loop->last)
                        <div class="session-arrow" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <section class="section" data-reveal-group>
        <div class="container">
            <div class="section-head section-head--center reveal">
                <h2>Chương trình phù hợp <span class="hl">từng độ tuổi</span></h2>
                <p>Ba nhóm lớp theo giai đoạn phát triển, mỗi nhóm một trọng tâm huấn luyện riêng.</p>
            </div>

            <div class="age-grid">
                @foreach ($ageCards as $i => $card)
                    <div class="age-card reveal reveal-d{{ $i + 1 }}">
                        <div class="age-card__media">
                            <span class="age-card__badge">{{ $card['age'] }}</span>
                            @if ($images[$card['image_key']] ?? null)
                                <img src="{{ asset('storage/' . $images[$card['image_key']]) }}" alt="Lớp {{ $card['name'] }} {{ $card['age'] }} tại Alpha Kids Football Club" loading="lazy">
                            @else
                                <div class="age-card__media-empty">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><rect x="3" y="5" width="18" height="14" rx="2" /><circle cx="9" cy="10.5" r="1.6" /><path d="M21 16l-5.5-5.5L9 17" /></svg>
                                    <span>Chưa có ảnh</span>
                                </div>
                            @endif
                        </div>
                        <div class="age-card__body">
                            <div class="age-card__icon">{!! $card['icon'] !!}</div>
                            <h3>{{ $card['name'] }}</h3>
                            <div class="age-card__rule"></div>
                            <p>{{ $card['desc'] }}</p>
                            <ul class="age-card__list">
                                @foreach ($card['points'] as $point)
                                    <li>{{ $point }}</li>
                                @endforeach
                            </ul>
                            <a href="{{ route('registration.create') }}" class="btn btn--outline btn--sm">Đăng ký lớp {{ $card['name'] }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="closing-cta" data-reveal-group>
        @if ($images['program_closing_cta_photo'] ?? null)
            <img class="closing-cta__photo" src="{{ asset('storage/' . $images['program_closing_cta_photo']) }}" alt="" loading="lazy">
        @endif
        <div class="closing-cta__scrim" aria-hidden="true"></div>
        <div class="container closing-cta__inner reveal">
            <h2>Đồng hành cùng con trên <span class="text-accent-free">mỗi chặng đường</span> trưởng thành</h2>
            <p class="closing-cta__note">Đăng ký buổi học thử để trải nghiệm chương trình huấn luyện bài bản tại Alpha Kids Football Club.</p>
            <div class="closing-cta__actions">
                <a href="{{ route('registration.create') }}" class="btn btn--accent">Đăng ký học thử ngay</a>
            </div>
        </div>
    </section>

    <script type="application/ld+json">
        {!! json_encode([
            '@@context' => 'https://schema.org',
            '@type' => 'Course',
            'name' => 'Chương trình dạy bóng đá tư duy Alpha Kids',
            'description' => 'Lộ trình huấn luyện bóng đá tư duy 12 tháng cho trẻ từ 3-14 tuổi, chia theo 3 nhóm độ tuổi tại Alpha Kids Football Club.',
            'url' => route('program'),
            'provider' => [
                '@type' => 'Organization',
                'name' => 'Alpha Kids Football Club',
                'sameAs' => url('/'),
            ],
            'hasCourseInstance' => collect($ageCards)->map(fn ($card) => [
                '@type' => 'CourseInstance',
                'name' => 'Lớp ' . $card['name'] . ' (' . $card['age'] . ')',
                'courseMode' => 'Onsite',
            ])->all(),
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>

</div>
@endsection
