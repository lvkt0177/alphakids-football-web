@extends('layouts.client', [
    'title' => 'Về CLB',
    'description' => 'Tầm nhìn, sứ mệnh và giá trị cốt lõi của Alpha Kids Football Club, câu lạc bộ bóng đá tư duy dành cho trẻ từ 3 tuổi.',
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/client/about.css') }}?v={{ filemtime(public_path('css/client/about.css')) }}">
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
            <h1>Về <span class="hl">câu lạc bộ</span></h1>
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
                    <p>Trở thành hệ thống câu lạc bộ bóng đá giáo dục hàng đầu dành cho trẻ em tại Việt Nam, được phụ huynh tin tưởng lựa chọn và là nơi ươm mầm một thế hệ tự tin, kỷ luật và có tư duy tích cực.</p>
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
                <h2>Giá trị <span class="hl">cốt lõi</span></h2>
            </div>
            <div class="value-bento">
                <div class="value-card value-card--featured reveal reveal-d1">
                    <div class="icon-roundel">
                        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6z" /></svg>
                    </div>
                    <h4>KỶ LUẬT</h4>
                    <p>Giúp trẻ hình thành thói quen đúng và biết chịu trách nhiệm.</p>
                </div>
                <div class="value-card reveal reveal-d2">
                    <div class="icon-roundel">
                        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M7 12l3 3 7-7" /><path d="M4 16l3-3M20 16l-3-3" /></svg>
                    </div>
                    <h4>TÔN TRỌNG</h4>
                    <p>Tôn trọng bản thân, đồng đội, HLV và đối thủ.</p>
                </div>
                <div class="value-card reveal reveal-d3">
                    <div class="icon-roundel">
                        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v6M12 22v-6M4 12h6M14 12h6" /><circle cx="12" cy="12" r="3" /></svg>
                    </div>
                    <h4>NỖ LỰC</h4>
                    <p>Khuyến khích trẻ luôn cố gắng vượt qua giới hạn của chính mình.</p>
                </div>
                <div class="value-card value-card--alt reveal reveal-d4">
                    <div class="icon-roundel">
                        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3" /><circle cx="17" cy="9" r="2.6" /><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6M15 20c.3-2.2 1.7-4 3.6-4.8" /></svg>
                    </div>
                    <h4>ĐOÀN KẾT</h4>
                    <p>Biết phối hợp, sẻ chia và cùng nhau phát triển.</p>
                </div>
                <div class="value-card reveal reveal-d5">
                    <div class="icon-roundel">
                        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17l6-6 4 4 8-8" /><path d="M15 7h6v6" /></svg>
                    </div>
                    <h4>TIẾN BỘ</h4>
                    <p>Mỗi ngày tốt hơn một chút so với ngày hôm qua.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section section--alt section--padding-block-80" data-reveal-group>
        <div class="container">
            <div class="section-head section-head--center reveal">
                <h2>Đôi lời <span class="hl">tâm sự</span></h2>
                <p>Không phải con số, mà là tấm lòng của những người trực tiếp đồng hành cùng các con mỗi ngày.</p>
            </div>

            @if (filled($letter['message']))
                <div class="letter-block reveal reveal-d2">
                    <div>
                        <div class="letter-portrait__frame" aria-hidden="true">
                            @if ($images['about_letter_photo'] ?? null)
                                <img src="{{ asset('storage/' . $images['about_letter_photo']) }}" alt="">
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
            <img class="closing-cta__photo" src="{{ asset('storage/' . $images['about_closing_cta_photo']) }}" alt="">
        @endif
        <div class="closing-cta__scrim closing-cta__scrim-about" aria-hidden="true"></div>
        <div class="container closing-cta__inner reveal">
            <h2>Đồng hành cùng chúng tôi</h2>
            <h2><span class="text-accent-free">Vì tương lai của con trẻ</span></h2>
            <p class="closing-cta__note closing-cta__note--about"><b>Alpha Kids Football Club</b> luôn chào đón các bé và phụ huynh đến trải nghiệm môi trường giáo dục thể thao khác biệt.</p>
            <div class="closing-cta__actions">
                <a href="{{ route('registration.create') }}" class="btn btn--accent">Đăng ký học thử</a>
            </div>
        </div>
    </section>

</div>
@endsection
