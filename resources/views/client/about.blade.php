@extends('layouts.client', [
    'title' => 'Về CLB',
    'description' => 'Tầm nhìn, sứ mệnh và mô hình 4 tư duy phát triển toàn diện của Alpha Kids Football Club, câu lạc bộ bóng đá tư duy dành cho trẻ từ 3 tuổi.',
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/client/about.css') }}?v={{ filemtime(public_path('css/client/about.css')) }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/client/about.js') }}?v={{ filemtime(public_path('js/client/about.js')) }}" defer></script>
@endpush

@section('content')
<div class="about-page">

    <section class="page-hero @if ($images['about_banner'] ?? null) page-hero--photo @endif">
        @if ($images['about_banner'] ?? null)
            <div class="page-hero__photo" aria-hidden="true">
                <img src="{{ asset('storage/' . $images['about_banner']) }}" alt="">
            </div>
            <div class="page-hero__scrim" aria-hidden="true"></div>
        @endif
        <div class="container">
            <h1>Về <span class="hl">CLB bóng đá tư duy</span></h1>
            <p>Học viện bóng đá tư duy, nơi trẻ phát triển toàn diện thể chất, tư duy và nhân cách.</p>
        </div>
    </section>

    <section class="section section--alt" data-reveal-group>
        <div class="container">
            <div class="section-head section-head--center reveal">
                <h2>Giới thiệu <span class="hl">Alpha Kids Football Club</span></h2>
                <p>Chúng tôi tin rằng mỗi đứa trẻ đều có tiềm năng riêng. Khi được học tập trong môi trường tích cực, được khuyến khích đúng cách và được trải nghiệm thường xuyên, các em sẽ phát triển toàn diện cả về thể chất lẫn tinh thần và trở thành phiên bản tốt nhất của chính mình.</p>
            </div>
            <div class="value-pair">
                <div class="value-pair__card reveal reveal-d1">
                    <div class="icon-roundel">
                        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="12" r="4" /><circle cx="16" cy="12" r="4" /><path d="M12 12h0" /></svg>
                    </div>
                    <h3>Tầm nhìn</h3>
                    <div class="value-pair__rule"></div>
                    <p>Ươm mầm một thế hệ trẻ khỏe mạnh, tự tin và có tư duy thông qua bóng đá; để mỗi đứa trẻ không chỉ chơi bóng tốt hơn mà còn trở thành phiên bản tốt hơn của chính mình.</p>
                </div>
                <div class="value-pair__card reveal reveal-d2">
                    <div class="icon-roundel">
                        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="8" /><circle cx="12" cy="12" r="4" /><circle cx="12" cy="12" r=".5" /></svg>
                    </div>
                    <h3>Sứ mệnh</h3>
                    <div class="value-pair__rule"></div>
                    <p>Sử dụng bóng đá như một công cụ giáo dục để giúp trẻ phát triển thể chất, tư duy, kỹ năng sống và những phẩm chất cần thiết cho tương lai.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section section--padding-block-80" data-reveal-group>
        <div class="container">
            <div class="section-head section-head--center reveal">
                <h2>Mô hình 4 tư duy phát triển <span class="hl">toàn diện</span></h2>
                <p>4 nhóm tư duy được lồng ghép trong mọi bài học và hoạt động, giúp trẻ hình thành nền tảng vững chắc
                    cho tương lai.</p>
            </div>
            <div class="pillar-bento" id="pillarBento">
                <svg class="pillar-bento__line" viewBox="0 0 100 100" aria-hidden="true">
                    <path data-pillar-path d="M25,25 L75,25 L25,75 L75,75" />
                    <circle data-pillar-dot cx="25" cy="25" r="4"></circle>
                    <circle data-pillar-dot cx="75" cy="25" r="4"></circle>
                    <circle data-pillar-dot cx="25" cy="75" r="4"></circle>
                    <circle data-pillar-dot cx="75" cy="75" r="4"></circle>
                </svg>

                <div class="pillar-card" data-pillar-card>
                    <span class="pillar-card__ghost" aria-hidden="true">01</span>
                    <div class="pillar-card__icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M4 5h16a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H9l-4 4v-4H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1z" />
                        </svg>
                    </div>
                    <h3>Tư duy giao tiếp</h3>
                    <p>Biết lắng nghe, diễn đạt và hợp tác hiệu quả. Trẻ học cách chia sẻ ý tưởng rõ ràng và phối hợp ăn
                        ý cùng đồng đội trên sân.</p>
                </div>

                <div class="pillar-card" data-pillar-card>
                    <span class="pillar-card__ghost" aria-hidden="true">02</span>
                    <div class="pillar-card__icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 12s3.8-6.2 10-6.2S22 12 22 12s-3.8 6.2-10 6.2S2 12 2 12z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </div>
                    <h3>Tư duy đánh giá</h3>
                    <p>Biết quan sát, phân tích và đưa ra quyết định. Mỗi tình huống trên sân là một bài học về nhìn
                        nhận đúng sai và chọn hướng xử lý phù hợp.</p>
                </div>

                <div class="pillar-card" data-pillar-card>
                    <span class="pillar-card__ghost" aria-hidden="true">03</span>
                    <div class="pillar-card__icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="12" r="6" />
                            <circle cx="15" cy="12" r="6" />
                        </svg>
                    </div>
                    <h3>Tư duy ứng xử</h3>
                    <p>Biết tôn trọng, hỗ trợ và giải quyết vấn đề. Trẻ rèn thói quen ứng xử đúng mực với đồng đội, đối
                        thủ và trọng tài trong mọi tình huống.</p>
                </div>

                <div class="pillar-card" data-pillar-card>
                    <span class="pillar-card__ghost" aria-hidden="true">04</span>
                    <div class="pillar-card__icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 3v18" />
                            <path d="M5 4h13l-3 4 3 4H5" />
                        </svg>
                    </div>
                    <h3>Tư duy lãnh đạo</h3>
                    <p>Biết chịu trách nhiệm, truyền cảm hứng và dẫn dắt đội nhóm. Từ vai trò nhỏ nhất trên sân, trẻ học
                        cách làm gương và dẫn dắt tập thể tiến lên.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section section--alt section--padding-block-80" data-reveal-group>
        <div class="container">
            <div class="section-head section-head--center reveal">
                <h2>Góc chia sẻ <span class="hl">của thầy</span></h2>
                <p>Không phải con số, mà là tấm lòng của những người trực tiếp đồng hành cùng các con mỗi ngày.</p>
            </div>

            @if (filled($letter['message']))
                <div class="letter-block reveal reveal-d2">
                    <div>
                        <div class="letter-portrait__frame" aria-hidden="true">
                            @if ($images['about_letter_photo'] ?? null)
                                <img src="{{ asset('storage/' . $images['about_letter_photo']) }}"
                                    alt="{{ $letter['name'] ?: 'Đại diện CLB' }}{{ $letter['role'] ? ', ' . $letter['role'] : '' }} - Alpha Kids Football Club"
                                    loading="lazy">
                            @endif
                        </div>
                        <div class="letter-portrait__caption">
                            <span class="letter-portrait__name">{{ $letter['name'] ?: 'Đại diện CLB' }}</span>
                            @if ($letter['role'])
                                <span class="letter-portrait__role">{{ $letter['role'] }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="letter-body">
                        <div class="letter-body__text">
                            @foreach (explode("\n", $letter['message']) as $paragraph)
                                @continue(trim($paragraph) === '')
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>
                        <div class="letter-body__rule" aria-hidden="true"></div>
                    </div>
                </div>
            @else
                <div class="letter-empty reveal">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" aria-hidden="true">
                        <path d="M7 8h10M7 12h6M4 4h16v11H9l-5 4V4z" />
                    </svg>
                    <p>Nội dung đang được cập nhật.</p>
                </div>
            @endif
        </div>
    </section>

    <section class="closing-cta" data-reveal-group>
        @if ($images['about_closing_cta_photo'] ?? null)
            <img class="closing-cta__photo" src="{{ asset('storage/' . $images['about_closing_cta_photo']) }}" alt="" loading="lazy">
        @endif
        <div class="closing-cta__scrim closing-cta__scrim-about" aria-hidden="true"></div>
        <div class="container closing-cta__inner reveal">
            <h2>Đồng hành cùng chúng tôi, <span class="text-accent-free">vì tương lai của con trẻ</span></h2>
            <p class="closing-cta__note closing-cta__note--about"><b>Alpha Kids Football Club</b> luôn chào đón các bé và phụ huynh đến trải nghiệm môi trường giáo dục thể thao khác biệt.</p>
            <div class="closing-cta__actions">
                <a href="{{ route('registration.create') }}" class="btn btn--accent">Đăng ký học thử</a>
            </div>
        </div>
    </section>

    <script type="application/ld+json">
        {!! json_encode([
            '@@context' => 'https://schema.org',
            '@type' => 'SportsActivityLocation',
            'name' => 'Alpha Kids Football Club',
            'url' => route('about'),
            'logo' => asset('images/logo/logo.jpg'),
            'description' => 'Tầm nhìn, sứ mệnh và mô hình 4 tư duy phát triển toàn diện của Alpha Kids Football Club, câu lạc bộ bóng đá tư duy dành cho trẻ từ 3 tuổi.',
            'sport' => 'Soccer',
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>

</div>
@endsection
