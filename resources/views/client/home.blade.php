@extends('layouts.client', [
    'headerVariant' => 'transparent',
    'title' => 'Trang chủ',
    'description' => 'Alpha Kids Football Club - Bóng đá tư duy dành cho trẻ từ 3 tuổi. Đào tạo cầu thủ, đồng hành cùng trẻ phát triển tư duy, nhân cách và sự tự tin.',
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/client/home.css') }}?v={{ filemtime(public_path('css/client/home.css')) }}">
@endpush

@section('content')
    <section class="hero">
        <img src="{{ asset('images/home/background.png') }}" alt="" class="hero__paint" aria-hidden="true">

        <div class="hero__photo">
            @if ($bannerImage)
                <img src="{{ asset('storage/' . $bannerImage) }}" alt="Học viên Alpha Kids Football Club">
                <div class="hero__photo-overlay" aria-hidden="true"></div>
            @else
                <div class="hero__photo-empty">
                    <p class="hero__photo-note">Chưa có ảnh banner<br>(vào Admin → Trang chủ → Hình ảnh để tải lên)</p>
                </div>
            @endif
        </div>

        <div class="container hero__inner">
            <div class="hero__content">
                <div class="hero__title-group">
                    <div class="hero__title">
                        <span class="hero__title-football">BÓNG ĐÁ</span>
                        <span class="hero__title-thinking">TƯ DUY</span>
                        <p class="hero__subtitle">Dành cho trẻ từ 3 tuổi</p>
                    </div>
                </div>
                <p class="hero__desc">
                    Không chỉ đào tạo cầu thủ, chúng tôi đồng hành cùng trẻ phát triển tư duy, nhân cách và sự tự tin
                    thông qua môi trường bóng đá tích cực.
                </p>

                <ul class="hero__checklist">
                    <li>
                        <svg viewBox="0 0 24 24">
                            <path d="M9 16.2 4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4z" />
                        </svg>
                        Giáo trình khoa học theo từng độ tuổi
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24">
                            <path d="M9 16.2 4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4z" />
                        </svg>
                        Phương pháp huấn luyện C.A.R.E
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24">
                            <path d="M9 16.2 4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4z" />
                        </svg>
                        Phát triển 4 tư duy cốt lõi
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24">
                            <path d="M9 16.2 4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4z" />
                        </svg>
                        Học mà chơi — chơi để trưởng thành
                    </li>
                </ul>

                <div class="hero__actions">
                    <a href="{{ route('registration.create') }}" class="btn btn--accent btn--register">Đăng ký học thử</a>
                    <a href="{{ route('program') }}" class="btn btn--outline btn--learn-more">Tìm hiểu chương trình</a>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ 4 TƯ DUY CỐT LÕI ============ --}}
    <section class="pillars">
        <div class="container pillars__grid">
            <div class="pillar-card pillar-card--teal">
                <div class="pillar-card__icon">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M10.6 3c-4.14 0-7.5 2.8-7.5 6.25 0 2 1.13 3.78 2.9 4.94-.12 1-.5 1.9-1.14 2.66a.4.4 0 0 0 .4.65c1.4-.3 2.6-.87 3.58-1.6.58.1 1.17.16 1.76.16 4.14 0 7.5-2.8 7.5-6.25S14.74 3 10.6 3z" />
                        <path class="cutout"
                            d="M8.2 9.9a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm2.6 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm2.6 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        <path
                            d="M20.4 12.2c1.02.72 1.6 1.72 1.6 2.8 0 1.13-.62 2.16-1.66 2.9-.05.72.16 1.4.6 1.98a.32.32 0 0 1-.33.5 5.2 5.2 0 0 1-2.05-.87c-.4.08-.82.12-1.26.12-2.2 0-4.06-1.02-4.77-2.44 2.9-.42 5.2-2.2 5.85-4.5.02.05.7.24 2.02-.49z" />
                    </svg>
                </div>
                <h3><span class="pillar-card__title-base">Tư duy giao</span> <span class="pillar-card__title-accent">tiếp</span></h3>
                <p>Biết lắng nghe và chia sẻ.</p>
            </div>

            <div class="pillar-card pillar-card--blue">
                <div class="pillar-card__icon">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M12.3 2.8c-4.32 0-7.8 3.24-7.8 7.24 0 2.9 1.83 5.4 4.46 6.6-.1.92-.42 1.76-1 2.46a.35.35 0 0 0 .34.57c1.2-.24 2.24-.72 3.05-1.35.3.04.6.06.95.06 4.3 0 7.8-3.24 7.8-7.34s-3.5-7.24-7.8-7.24z" />
                        <circle class="cutout" cx="10.3" cy="9.6" r="1.3" />
                        <circle class="cutout" cx="13.7" cy="9.6" r="1.3" />
                        <path class="cutout" d="M10.4 11.6c0 .95.8 1.7 1.7 1.7s1.7-.75 1.7-1.7"
                            fill="none" stroke="currentColor" stroke-width="1.1" />
                    </svg>
                </div>
                <h3><span class="pillar-card__title-base">Tư duy đánh</span> <span class="pillar-card__title-accent">giá</span></h3>
                <p>Biết nhìn lại bản thân và kiểm soát cảm xúc.</p>
            </div>

            <div class="pillar-card pillar-card--orange">
                <div class="pillar-card__icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="6.3" r="2.15" />
                        <circle cx="6.1" cy="7.9" r="1.7" />
                        <circle cx="17.9" cy="7.9" r="1.7" />
                        <path
                            d="M12 9.3c-2.28 0-4.1 1.72-4.1 3.98v3.13c0 .5.4.9.9.9h6.4c.5 0 .9-.4.9-.9v-3.13c0-2.26-1.82-3.98-4.1-3.98z" />
                        <path opacity=".92"
                            d="M6.1 10.3c-1.87 0-3.35 1.4-3.35 3.2v2.55c0 .4.32.72.72.72h2.03v-3.27c0-1 .28-1.9.77-2.66a3.2 3.2 0 0 0-.17-.54z" />
                        <path opacity=".92"
                            d="M17.9 10.3c1.87 0 3.35 1.4 3.35 3.2v2.55c0 .4-.32.72-.72.72h-2.03v-3.27c0-1-.28-1.9-.77-2.66.06-.19.11-.36.17-.54z" />
                    </svg>
                </div>
                <h3><span class="pillar-card__title-base">Tư duy ứng</span> <span class="pillar-card__title-accent">xử</span></h3>
                <p>Biết hợp tác và giúp đỡ người khác.</p>
            </div>

            <div class="pillar-card pillar-card--purple">
                <div class="pillar-card__icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="5.7" r="2.3" />
                        <circle cx="6" cy="8.3" r="1.8" />
                        <circle cx="18" cy="8.3" r="1.8" />
                        <path
                            d="M12 9.1c-2.5 0-4.5 1.87-4.5 4.18v3.32c0 .5.4.9.9.9h7.2c.5 0 .9-.4.9-.9v-3.32C16.5 10.97 14.5 9.1 12 9.1z" />
                        <path opacity=".92"
                            d="M6 10.8c-1.93 0-3.5 1.45-3.5 3.24v2.63c0 .4.32.72.72.72H5v-3.44c0-.96.27-1.86.75-2.6-.2-.36-.46-.55-.75-.55z" />
                        <path opacity=".92"
                            d="M18 10.8c1.93 0 3.5 1.45 3.5 3.24v2.63c0 .4-.32.72-.72.72H19v-3.44c0-.96-.27-1.86-.75-2.6.2-.36.46-.55.75-.55z" />
                    </svg>
                </div>
                <h3><span class="pillar-card__title-base">Tư duy lãnh</span> <span class="pillar-card__title-accent">đạo</span></h3>
                <p>Biết chịu trách nhiệm và truyền cảm hứng.</p>
            </div>
        </div>
    </section>
@endsection