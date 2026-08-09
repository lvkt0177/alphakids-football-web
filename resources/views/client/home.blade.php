@extends('layouts.client', [
    'headerVariant' => 'transparent',
    'title' => 'Trang chủ',
    'description' => 'Alpha Kids Football Club - Bóng đá tư duy dành cho trẻ từ 3 tuổi. Đào tạo cầu thủ, đồng hành cùng trẻ phát triển tư duy, nhân cách và sự tự tin.',
])

@push('styles')
    <link rel="stylesheet"
        href="{{ asset('css/client/home.css') }}?v={{ filemtime(public_path('css/client/home.css')) }}">
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
                <h1 class="hero__title">
                    BÓNG ĐÁ
                    <span>TƯ DUY</span>
                    <p class="hero__subtitle">Dành cho trẻ từ 3 tuổi</p>
                </h1>
                <p class="hero__desc">
                    Không chỉ đào tạo cầu thủ, chúng tôi đồng hành cùng trẻ phát triển tư duy, nhân cách và sự tự tin
                    thông qua môi trường bóng đá tích cực.
                </p>

                <ul class="hero__checklist">
                    <li>
                        <svg viewBox="0 0 24 24"><path d="M9 16.2 4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4z"/></svg>
                        Giáo trình khoa học theo từng độ tuổi
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24"><path d="M9 16.2 4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4z"/></svg>
                        Phương pháp huấn luyện C.A.R.E
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24"><path d="M9 16.2 4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4z"/></svg>
                        Phát triển 4 tư duy cốt lõi
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24"><path d="M9 16.2 4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4z"/></svg>
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
                    <svg viewBox="0 0 24 24"><path d="M4 4h16a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1H9l-4.4 3.6A1 1 0 0 1 3 19.8V5a1 1 0 0 1 1-1z"/></svg>
                </div>
                <h3>Tư duy giao tiếp</h3>
                <p>Biết lắng nghe và chia sẻ.</p>
            </div>

            <div class="pillar-card pillar-card--blue">
                <div class="pillar-card__icon">
                    <svg viewBox="0 0 24 24"><path d="M12 2a7 7 0 0 0-4 12.7V17a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-2.3A7 7 0 0 0 12 2zM9 21a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-1H9v1z"/></svg>
                </div>
                <h3>Tư duy đánh giá</h3>
                <p>Biết nhìn lại bản thân và kiểm soát cảm xúc.</p>
            </div>

            <div class="pillar-card pillar-card--orange">
                <div class="pillar-card__icon">
                    <svg viewBox="0 0 24 24"><path d="M16 11a3.5 3.5 0 1 0-3.4-4.3A3.5 3.5 0 0 0 16 11zm-8 0a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zm0 2c-2.7 0-8 1.3-8 4v2h9.3a5.9 5.9 0 0 1-.3-2c0-1.6.7-3 1.8-4A13 13 0 0 0 8 13zm8 0c-.4 0-.8 0-1.3.1a6 6 0 0 1 2.3 4.9c0 .7-.1 1.4-.3 2H24v-2c0-2.7-5.3-4-8-4z"/></svg>
                </div>
                <h3>Tư duy ứng xử</h3>
                <p>Biết hợp tác và giúp đỡ người khác.</p>
            </div>

            <div class="pillar-card pillar-card--purple">
                <div class="pillar-card__icon">
                    <svg viewBox="0 0 24 24"><path d="M12 2 4 6v6c0 5 3.4 8.7 8 10 4.6-1.3 8-5 8-10V6l-8-4zm0 4.5 4.5 2.2v3.3c0 3.3-2.2 5.9-4.5 6.7-2.3-.8-4.5-3.4-4.5-6.7V8.7L12 6.5z"/></svg>
                </div>
                <h3>Tư duy lãnh đạo</h3>
                <p>Biết chịu trách nhiệm và truyền cảm hứng.</p>
            </div>
        </div>
    </section>
@endsection