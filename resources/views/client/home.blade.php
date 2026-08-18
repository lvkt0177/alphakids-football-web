@extends('layouts.client', [
    'headerVariant' => 'transparent',
    'title' => 'Alpha Kids Football Club',
    'description' => 'Alpha Kids Football Club - Bóng đá tư duy dành cho trẻ từ 3 tuổi. Đào tạo cầu thủ, đồng hành cùng trẻ phát triển tư duy, nhân cách và sự tự tin.',
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/client/home.css') }}?v={{ filemtime(public_path('css/client/home.css')) }}">
@endpush

@section('content')
    <div class="home-page">

        <section class="hero" id="hero">
            <div class="hero__photo" id="heroPhoto">
                @if ($images['home_banner'] ?? null)
                    <picture>
                        @if ($images['home_banner_mobile'] ?? null)
                            <source media="(max-width: 768px)"
                                srcset="{{ asset('storage/' . $images['home_banner_mobile']) }}">
                        @endif
                        <img src="{{ asset('storage/' . ($images['home_banner_desktop'] ?? $images['home_banner'])) }}"
                            alt="Học viên Alpha Kids Football Club" id="heroPhotoImg" fetchpriority="high"
                            decoding="async">
                    </picture>
                @else
                    <div class="hero__photo-empty" id="heroPhotoImg"></div>
                @endif
                <div class="hero__photo-overlay" aria-hidden="true"></div>
            </div>

            <div class="container hero__inner">
                <div class="hero__content">
                    <span class="hero__eyebrow-line" aria-hidden="true"></span>

                    <h1 class="hero__title-group">
                        <span class="hero__title-football">BÓNG ĐÁ</span>
                        <span class="hero__title-thinking">TƯ DUY</span>
                    </h1>
                    <p class="hero__subtitle">Dành cho trẻ từ 3 tuổi</p>

                    <p class="hero__desc">
                        Không chỉ đào tạo cầu thủ, chúng tôi đồng hành cùng trẻ phát triển tư duy, nhân cách và sự tự tin
                        thông qua môi trường bóng đá tích cực.
                    </p>

                    <div class="hero__actions">
                        <a href="{{ route('registration.create') }}" class="btn btn--accent btn--register">Đăng ký học
                            thử</a>
                        <a href="{{ route('program') }}" class="btn btn--outline-invert btn--learn-more">Tìm hiểu chương
                            trình</a>
                    </div>
                </div>

                @unless ($images['home_banner'] ?? null)
                    <p class="hero__photo-note">Chưa có ảnh banner (vào Admin → Trang chủ → Hình ảnh để tải lên)</p>
                @endunless
            </div>
        </section>

        <section class="highlight-strip" data-reveal-group>
            <div class="container highlight-strip__row">
                <div class="highlight-strip__item reveal reveal-d1">Giáo trình khoa học theo từng độ tuổi</div>
                <div class="highlight-strip__item reveal reveal-d2">Phương pháp huấn luyện C.A.R.E</div>
                <div class="highlight-strip__item reveal reveal-d3">Phát triển 4 tư duy cốt lõi</div>
                <div class="highlight-strip__item reveal reveal-d4">Học mà chơi, chơi mà học</div>
            </div>
        </section>

        <section class="hp-section" data-reveal-group>
            <div class="container club-intro">
                <div class="club-intro__frame reveal">
                    @if ($images['home_club_intro'] ?? null)
                        <img src="{{ asset('storage/' . $images['home_club_intro']) }}"
                            alt="Đội hình Alpha Kids Football Club" loading="lazy" decoding="async">
                    @else
                        <div class="club-intro__frame-empty">
                            <svg viewBox="0 0 24 24" fill="none" stroke="var(--ink)" stroke-width="1.4"
                                aria-hidden="true">
                                <rect x="3" y="5" width="18" height="14" rx="2" />
                                <circle cx="9" cy="10" r="2" />
                                <path d="M3 17l5-4 4 3 4-5 5 6" />
                            </svg>
                        </div>
                    @endif
                </div>

                <div class="club-intro__body reveal reveal-d2">
                    <h2>Mỗi buổi tập là một bài học <span class="hl">trưởng thành</span></h2>
                    <p>
                        Alpha Kids Football Club tin rằng bóng đá không chỉ giúp trẻ khỏe mạnh mà còn tạo nên những phẩm
                        chất quan trọng cho tương lai.
                    </p>
                    <p>
                        Thông qua giáo trình khoa học và phương pháp huấn luyện riêng, trẻ được phát triển đồng thời về thế
                        chất, tư duy và kỹ năng sống trong một môi trường tích cực, an toàn và đầy cảm hứng.
                    </p>
                    <div class="club-intro__actions">
                        <a href="{{ route('about') }}" class="btn btn--outline">Tìm hiểu về CLB</a>
                        <a href="{{ route('branch.index') }}" class="club-intro__branch-link">Xem cơ sở gần bạn
                            <span aria-hidden="true">→</span></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="hp-section intro-video-section" data-reveal-group id="introVideoSection">
            <span class="intro-video-section__dark-bg" id="introVideoBgSplit" aria-hidden="true"></span>

            <div class="container">
                <div class="intro-video__lead reveal">
                    <h2>Một ngày học tại <span class="hl">Alpha Kids</span></h2>
                    <p>Học mà chơi, chơi mà học.</p>
                </div>
            </div>

            <div class="container">
                <div class="intro-video-feature reveal reveal-d2">
                    <div class="intro-video__stage" id="introVideoStage">
                        @if ($videoMode === 'youtube' && $videoYoutubeUrl)
                            <iframe
                                src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::of($videoYoutubeUrl)->after('v=')->before('&') }}"
                                title="Video giới thiệu Alpha Kids Football Club"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        @elseif ($videoMode === 'upload' && $videoFile)
                            <video controls id="introVideoEl"
                                @if ($images['home_video_thumbnail'] ?? null) poster="{{ asset('storage/' . $images['home_video_thumbnail']) }}" @endif>
                                <source src="{{ asset('storage/' . $videoFile) }}" type="video/mp4">
                            </video>
                            <button type="button" class="intro-video__play-hint" id="introVideoPlayHint"
                                aria-label="Phát video">
                                <svg viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                            </button>
                        @else
                            <p class="intro-video__empty">Video giới thiệu đang được cập nhật.</p>
                        @endif
                    </div>
                    <span class="intro-video__caption">Triết lý xuyên suốt mọi buổi tập tại Alpha Kids</span>
                </div>
            </div>
        </section>

        <section class="hp-section timeline-section" data-reveal-group>
            <div class="container">
                <div class="section-head section-head--center" style="margin-inline:auto;">
                    <h2>Hành trình phát triển <span class="hl">4 tư duy cốt lõi</span></h2>
                    <p style="margin-inline:auto;">Từng bước một, trẻ được dẫn dắt qua 4 chặng tư duy, nối tiếp nhau như
                        một đường chuyền có chủ đích.</p>
                </div>
            </div>

            <div class="timeline-stack" id="timelineStack">
                <div class="timeline-stack__rail">
                    <div class="timeline-dots" id="timelineDots" aria-hidden="true">
                        <span class="timeline-dots__item" data-timeline-dot></span>
                        <span class="timeline-dots__item" data-timeline-dot></span>
                        <span class="timeline-dots__item" data-timeline-dot></span>
                        <span class="timeline-dots__item" data-timeline-dot></span>
                    </div>
                    <div class="timeline-stack__rail-fill" id="timelineRailFill"></div>
                </div>

                <div class="timeline-panel" data-timeline-step>
                    <div class="container timeline-panel__inner">
                        <span class="timeline-panel__num">01</span>
                        <div class="timeline-panel__text">
                            <div class="timeline-panel__icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.4" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M4 5h16a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H9l-4 4v-4H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1z" />
                                </svg>
                            </div>
                            <h3>Giao tiếp</h3>
                            <span class="timeline-panel__underline" aria-hidden="true"></span>
                            <p>Lắng nghe và chia sẻ cùng đồng đội trong từng pha bóng, đây là nền tảng để ba tư duy còn lại
                                phát triển. Mỗi tình huống phối hợp trên sân là một lần trẻ tập gọi tên đồng đội, ra tín
                                hiệu và phản hồi lại - lặp lại đến khi trở thành phản xạ tự nhiên.</p>
                            <span class="timeline-panel__tag">Củng cố qua nguyên tắc <strong>Ask &amp; Answer</strong>
                                (C.A.R.E)</span>
                        </div>
                        @if ($images['home_pillar_photo'] ?? null)
                            <div class="timeline-panel__media" aria-hidden="true">
                                <div class="timeline-panel__visual">
                                    <img src="{{ asset('storage/' . $images['home_pillar_photo']) }}" alt=""
                                        loading="lazy" decoding="async">
                                </div>
                                <span class="timeline-panel__folio">01 <strong>/ 04</strong></span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="timeline-panel" data-timeline-step>
                    <div class="container timeline-panel__inner">
                        <span class="timeline-panel__num">02</span>
                        <div class="timeline-panel__text">
                            <div class="timeline-panel__icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M2 12s3.8-6.2 10-6.2S22 12 22 12s-3.8 6.2-10 6.2S2 12 2 12z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </div>
                            <h3>Đánh giá</h3>
                            <span class="timeline-panel__underline" aria-hidden="true"></span>
                            <p>Biết nhìn lại bản thân và kiểm soát cảm xúc sau mỗi pha bóng thắng hoặc thua. HLV lặp lại
                                cùng một tình huống nhiều lần để trẻ quen dần với việc tự đánh giá thay vì đổ lỗi hay nản
                                lòng.</p>
                            <span class="timeline-panel__tag">Củng cố qua nguyên tắc <strong>Repetition</strong>
                                (C.A.R.E)</span>
                        </div>
                        @if ($images['home_pillar_photo_2'] ?? null)
                            <div class="timeline-panel__media" aria-hidden="true">
                                <div class="timeline-panel__visual">
                                    <img src="{{ asset('storage/' . $images['home_pillar_photo_2']) }}" alt=""
                                        loading="lazy" decoding="async">
                                </div>
                                <span class="timeline-panel__folio">02 <strong>/ 04</strong></span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="timeline-panel" data-timeline-step>
                    <div class="container timeline-panel__inner">
                        <span class="timeline-panel__num">03</span>
                        <div class="timeline-panel__text">
                            <div class="timeline-panel__icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="9" cy="12" r="6" />
                                    <circle cx="15" cy="12" r="6" />
                                </svg>
                            </div>
                            <h3>Ứng xử</h3>
                            <span class="timeline-panel__underline" aria-hidden="true"></span>
                            <p>Biết hợp tác và giúp đỡ người khác, kể cả khi không cùng đội. Những khoảnh khắc tử tế nhỏ
                                trên sân được HLV ghi nhận ngay tại chỗ, để trẻ hiểu ứng xử tốt cũng đáng được trân trọng
                                như một bàn thắng.</p>
                            <span class="timeline-panel__tag">Củng cố qua nguyên tắc <strong>Celebrate</strong>
                                (C.A.R.E)</span>
                        </div>
                        @if ($images['home_pillar_photo_3'] ?? null)
                            <div class="timeline-panel__media" aria-hidden="true">
                                <div class="timeline-panel__visual">
                                    <img src="{{ asset('storage/' . $images['home_pillar_photo_3']) }}" alt=""
                                        loading="lazy" decoding="async">
                                </div>
                                <span class="timeline-panel__folio">03 <strong>/ 04</strong></span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="timeline-panel" data-timeline-step>
                    <div class="container timeline-panel__inner">
                        <span class="timeline-panel__num">04</span>
                        <div class="timeline-panel__text">
                            <div class="timeline-panel__icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M5 3v18" />
                                    <path d="M5 4h13l-3 4 3 4H5" />
                                </svg>
                            </div>
                            <h3>Lãnh đạo</h3>
                            <span class="timeline-panel__underline" aria-hidden="true"></span>
                            <p>Biết chịu trách nhiệm và truyền cảm hứng cho cả đội. Vai trò đội trưởng luân phiên qua từng
                                buổi tập, để mỗi trẻ đều có cơ hội thử thách bản thân ở vị trí dẫn dắt, không chỉ dành riêng
                                cho một vài bạn nổi trội.</p>
                            <span class="timeline-panel__tag">Củng cố qua nguyên tắc <strong>Enjoy &amp; Strict</strong>
                                (C.A.R.E)</span>
                        </div>
                        @if ($images['home_pillar_photo_4'] ?? null)
                            <div class="timeline-panel__media" aria-hidden="true">
                                <div class="timeline-panel__visual">
                                    <img src="{{ asset('storage/' . $images['home_pillar_photo_4']) }}" alt=""
                                        loading="lazy" decoding="async">
                                </div>
                                <span class="timeline-panel__folio">04 <strong>/ 04</strong></span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section class="hp-section hp-section--ink care" data-reveal-group>
            <div class="container">
                <div class="section-head section-head--center" style="margin-inline:auto;">
                    <h2>Phương pháp huấn luyện <span class="hl">C.A.R.E</span></h2>
                    <p style="margin-inline:auto;">4 nguyên tắc xuyên suốt mọi buổi tập tại Alpha Kids.</p>
                </div>

                <div class="care__layout">
                    <div class="care__manifesto">
                        <div class="care-row reveal reveal-d1">
                            <span class="care-row__letter">C</span>
                            <div class="care-row__text">
                                <h3>Celebrate</h3>
                                <span>Khích lệ</span>
                            </div>
                        </div>
                        <div class="care-row reveal reveal-d2">
                            <span class="care-row__letter">A</span>
                            <div class="care-row__text">
                                <h3>Ask &amp; Answer</h3>
                                <span>Hỏi &amp; Đáp</span>
                            </div>
                        </div>
                        <div class="care-row reveal reveal-d3">
                            <span class="care-row__letter">R</span>
                            <div class="care-row__text">
                                <h3>Repetition</h3>
                                <span>Lặp lại</span>
                            </div>
                        </div>
                        <div class="care-row reveal reveal-d4">
                            <span class="care-row__letter">E</span>
                            <div class="care-row__text">
                                <h3>Enjoy &amp; Strict</h3>
                                <span>Vui &amp; Kỷ luật</span>
                            </div>
                        </div>

                        <a href="{{ route('method') }}" class="btn btn--accent care__cta">Tìm hiểu phương pháp</a>
                    </div>

                    @if (($images['home_care_photo_1'] ?? null) || ($images['home_care_photo_2'] ?? null))
                        <div class="care__photos reveal reveal-d2">
                            @if ($images['home_care_photo_1'] ?? null)
                                <img src="{{ asset('storage/' . $images['home_care_photo_1']) }}"
                                    alt="Buổi tập theo phương pháp C.A.R.E tại Alpha Kids" loading="lazy"
                                    decoding="async">
                            @endif
                            @if ($images['home_care_photo_2'] ?? null)
                                <img src="{{ asset('storage/' . $images['home_care_photo_2']) }}"
                                    alt="Buổi tập theo phương pháp C.A.R.E tại Alpha Kids" loading="lazy"
                                    decoding="async">
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <section class="hp-section hp-section--alt" data-reveal-group>
            <div class="container">
                <div class="section-head section-head--center" style="margin-inline:auto;">
                    <h2>Các lớp học tại <span class="hl">Alpha Kids</span></h2>
                    <p style="margin-inline:auto;">Mỗi độ tuổi một lộ trình phù hợp, cùng chung phương pháp C.A.R.E.</p>
                </div>
            </div>

            <div class="scroll-track container" style="max-width:var(--container-max);">
                @php
                    $tiers = [
                        [
                            'key' => 'home_class_toddler',
                            'age' => '3-6 tuổi',
                            'name' => 'Mầm non',
                            'focus' => [
                                'Làm quen bóng qua trò chơi nhóm',
                                'Xây dựng tư duy giao tiếp',
                                'Vận động cơ bản, phối hợp tay-mắt',
                            ],
                        ],
                        [
                            'key' => 'home_class_primary',
                            'age' => '7-10 tuổi',
                            'name' => 'Tiểu học',
                            'focus' => [
                                'Kỹ thuật nền tảng: chuyền, kiểm soát bóng',
                                'Rèn tư duy đánh giá bản thân',
                                'Thi đấu nhóm nhỏ, học cách ứng xử',
                            ],
                        ],
                        [
                            'key' => 'home_class_teen',
                            'age' => '11-14 tuổi',
                            'name' => 'Cấp 2',
                            'focus' => [
                                'Chiến thuật thi đấu nâng cao',
                                'Phát triển tư duy lãnh đạo đội nhóm',
                                'Rèn kỷ luật và tinh thần trách nhiệm',
                            ],
                        ],
                    ];
                @endphp

                @foreach ($tiers as $i => $tier)
                    <div class="tier-card reveal reveal-d{{ $i + 1 }}">
                        <div class="tier-card__media">
                            @if ($images[$tier['key']] ?? null)
                                <img src="{{ asset('storage/' . $images[$tier['key']]) }}"
                                    alt="Lớp {{ $tier['name'] }}" loading="lazy" decoding="async">
                            @else
                                <div class="tier-card__media-empty">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--ink)" stroke-width="1.4"
                                        aria-hidden="true">
                                        <circle cx="12" cy="8" r="3.2" />
                                        <path d="M5 20c0-3.9 3.1-7 7-7s7 3.1 7 7" />
                                    </svg>
                                </div>
                            @endif
                            <span class="tier-card__age">{{ $tier['age'] }}</span>
                        </div>
                        <div class="tier-card__body">
                            <h3>{{ $tier['name'] }}</h3>
                            <ul class="tier-card__focus">
                                @foreach ($tier['focus'] as $point)
                                    <li>{{ $point }}</li>
                                @endforeach
                            </ul>
                            <a href="{{ route('program') }}" class="btn btn--outline btn--sm">Xem chi tiết</a>
                        </div>
                    </div>
                @endforeach

                <div class="tier-card tier-card--consult reveal reveal-d4">
                    <div class="tier-card__consult-body">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"
                            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M12 18h.01M8 8a4 4 0 1 1 6.5 3.1c-.9.7-1.5 1.3-1.5 2.4v.5" />
                        </svg>
                        <h3>Chưa chắc chọn lớp nào?</h3>
                        <p>Để lại thông tin, đội ngũ Alpha Kids sẽ tư vấn miễn phí lớp phù hợp nhất với độ tuổi của con.</p>
                        <a href="{{ route('registration.create') }}" class="btn btn--accent btn--sm">Tư vấn miễn phí</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="hp-section proof" data-reveal-group>
            <div class="container">
                <div class="section-head section-head--center" style="margin-inline:auto;">
                    <h2>Vì sao phụ huynh chọn <span class="hl">Alpha Kids</span></h2>
                    <p style="margin-inline:auto;">Những chia sẻ thật từ phụ huynh đang đồng hành cùng con tại Alpha
                        Kids.</p>
                </div>
            </div>

            @if ($proofPoints->isNotEmpty())
                <div class="proof-shell reveal reveal-d2 {{ $proofPoints->count() < 3 ? 'proof-shell--no-peek' : '' }}"
                    role="region" aria-roledescription="carousel" aria-label="Cảm nhận của phụ huynh">
                    <span class="proof-edge-fade left" aria-hidden="true"></span>
                    <span class="proof-edge-fade right" aria-hidden="true"></span>

                    <div class="proof-track">
                        <button type="button" class="proof-peek is-prev" id="proofPeekPrev" aria-label="Xem câu trước">
                            <p class="proof-peek__quote" id="proofPeekPrevQuote" aria-hidden="true"></p>
                            <span class="proof-peek__author" id="proofPeekPrevAuthor" aria-hidden="true"></span>
                        </button>

                        <div class="proof-spotlight" role="group" aria-roledescription="slide">
                            <span class="proof-spotlight__glyph" aria-hidden="true">&ldquo;</span>
                            <p class="proof-spotlight__quote" id="proofSpotQuote"></p>
                            <div class="proof-spotlight__author" id="proofSpotAuthor"></div>
                            <span class="proof-spotlight__mark" aria-hidden="true"></span>
                            <div class="proof-spotlight__dots" id="proofSpotDots"></div>
                        </div>

                        <button type="button" class="proof-peek is-next" id="proofPeekNext"
                            aria-label="Xem câu tiếp theo">
                            <p class="proof-peek__quote" id="proofPeekNextQuote" aria-hidden="true"></p>
                            <span class="proof-peek__author" id="proofPeekNextAuthor" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>

                <script type="application/json" id="proofQuotesData">{!! $proofPoints->map(fn($p) => ['quote' => $p->description, 'author' => $p->author_name])->values()->toJson() !!}</script>
            @else
                <div class="container">
                    <div class="testimonial-feature reveal">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"
                            aria-hidden="true">
                            <path d="M7 8h10M7 12h6M4 4h16v11H9l-5 4V4z" />
                        </svg>
                        <p>Nội dung đang được cập nhật.</p>
                    </div>
                </div>
            @endif
        </section>

        <section class="hp-section hp-section--alt" data-reveal-group>
            <div class="container">
                <div class="faq-section">
                    <div class="faq-section__head reveal">
                        <div class="faq-teaser__icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="9" />
                                <path d="M9.5 9a2.5 2.5 0 0 1 4.6-1.3c.5.8.3 1.6-.4 2.2-.7.6-1.2 1-1.2 2" />
                                <circle cx="12" cy="16.3" r=".2" fill="currentColor" stroke-width="1.2" />
                            </svg>
                        </div>
                        <div class="faq-teaser__text">
                            <h2>Câu hỏi thường gặp về Alpha Kids?</h2>
                            <p>Xem các câu hỏi thường gặp về lịch học, độ tuổi, cơ sở và phương pháp C.A.R.E.</p>
                        </div>
                    </div>

                    @if ($homeFaqs->isNotEmpty())
                        <div class="accordion accordion--boxed faq-section__accordion reveal" data-accordion>
                            @foreach ($homeFaqs as $faq)
                                <div class="accordion-item" data-accordion-item>
                                    <button type="button" class="accordion-item__trigger" data-accordion-trigger
                                        aria-expanded="false" aria-controls="faqHomeAnswer{{ $faq->id }}">
                                        <span>{{ $faq->question }}</span>
                                        <span class="accordion-item__icon" aria-hidden="true"></span>
                                    </button>
                                    <div class="accordion-item__panel" id="faqHomeAnswer{{ $faq->id }}"
                                        data-accordion-panel>
                                        <div class="accordion-item__panel-inner">
                                            <p>{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <a href="{{ route('faq') }}" class="btn btn--outline faq-section__cta reveal">Xem tất cả câu hỏi</a>
                </div>
            </div>
        </section>

        <section class="hp-section hp-section--activity" data-reveal-group>
            <div class="container">
                <div class="section-head section-head--center" style="margin-inline:auto;">
                    <h2>Hoạt động <span class="hl">nổi bật</span></h2>
                    <p style="margin-inline:auto;">Alpha Kids không chỉ có sân tập, mà còn có giải đấu, giao lưu, trại hè
                        và những ngày hội cả nhà cùng vui.</p>
                </div>
            </div>

            @if ($featuredActivities->isNotEmpty())
                <div class="scroll-track scroll-track--drag container" id="activitiesTrack"
                    style="max-width:var(--container-max);">
                    @foreach ($featuredActivities as $i => $activity)
                        <div class="activity-card reveal reveal-d{{ ($i % 4) + 1 }}">
                            @if ($activity->image)
                                <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->name }}"
                                    loading="lazy" decoding="async">
                            @else
                                <div class="activity-card__media-empty">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--ink)" stroke-width="1.4"
                                        aria-hidden="true">
                                        <rect x="3" y="5" width="18" height="14" rx="2" />
                                        <circle cx="9" cy="10" r="2" />
                                        <path d="M3 17l5-4 4 3 4-5 5 6" />
                                    </svg>
                                </div>
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

                    <a href="{{ route('activity.index') }}" class="activity-card activity-card--more reveal reveal-d4">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                        <span>Xem tất cả hoạt động</span>
                    </a>
                </div>
            @else
                <div class="container">
                    <div class="activities__empty">Hoạt động nổi bật đang được cập nhật, vào Admin để chọn hoạt động hiển
                        thị tại đây.</div>
                    <div class="activities__footer">
                        <a href="{{ route('activity.index') }}" class="btn btn--outline">Xem tất cả hoạt động</a>
                    </div>
                </div>
            @endif
        </section>

        <section class="closing-cta" data-reveal-group>
            @if ($images['home_closing_cta_photo'] ?? null)
                <img class="closing-cta__photo" src="{{ asset('storage/' . $images['home_closing_cta_photo']) }}"
                    alt="" loading="lazy" decoding="async">
            @endif
            <div class="closing-cta__scrim" aria-hidden="true"></div>

            <div class="container closing-cta__inner reveal">
                <h2>Đăng ký buổi học thử <span class="text-accent-free">miễn phí</span></h2>
                <p class="closing-cta__note">Học thử miễn phí - đội ngũ Alpha Kids sẽ liên hệ xác nhận lịch trong thời gian
                    sớm nhất.</p>
                <a href="{{ route('registration.create') }}" class="btn btn--accent">Đăng ký ngay</a>
            </div>
        </section>

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/client/home.js') }}?v={{ filemtime(public_path('js/client/home.js')) }}" defer></script>
@endpush
