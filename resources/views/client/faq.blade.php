@extends('layouts.client', [
    'title' => 'Câu hỏi thường gặp',
    'description' => 'Giải đáp các câu hỏi phụ huynh thường gặp về độ tuổi, học thử miễn phí, phương pháp C.A.R.E và hệ thống cơ sở của Alpha Kids Football Club.',
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/client/faq.css') }}?v={{ filemtime(public_path('css/client/faq.css')) }}">
@endpush

@section('content')
<div class="faq-page">

    <section class="page-hero @if ($images['faq_banner'] ?? null) page-hero--photo @endif">
        @if ($images['faq_banner'] ?? null)
            <div class="page-hero__photo" aria-hidden="true">
                <img src="{{ asset('storage/' . $images['faq_banner']) }}" alt="">
            </div>
            <div class="page-hero__scrim" aria-hidden="true"></div>
        @endif
        <div class="container">
            <h1>Câu hỏi <span class="hl">thường gặp</span></h1>
            <p>Những thắc mắc phụ huynh thường đặt ra trước khi đăng ký học thử tại Alpha Kids Football Club.</p>
        </div>
    </section>

    <section class="section" data-reveal-group>
        <div class="container">
            <div class="section-head section-head--center reveal">
                <h2>Câu hỏi thường gặp <span class="hl">dành cho phụ huynh</span></h2>
                <p>Chưa tìm thấy điều bạn thắc mắc? Đăng ký học thử để được đội ngũ Alpha Kids tư vấn trực tiếp.</p>
            </div>

            <div class="faq-body__inner reveal reveal-d1">
                @if ($faqs->isNotEmpty())
                    <div class="accordion accordion--boxed faq-body__accordion" data-accordion>
                        @foreach ($faqs as $faq)
                            <div class="accordion-item" data-accordion-item>
                                <button type="button" class="accordion-item__trigger" data-accordion-trigger
                                    aria-expanded="false" aria-controls="faqAnswer{{ $faq->id }}">
                                    <span>{{ $faq->question }}</span>
                                    <span class="accordion-item__icon" aria-hidden="true"></span>
                                </button>
                                <div class="accordion-item__panel" id="faqAnswer{{ $faq->id }}" data-accordion-panel>
                                    <div class="accordion-item__panel-inner">
                                        <p>{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="faq-body__empty">Nội dung câu hỏi thường gặp đang được cập nhật.</div>
                @endif
            </div>
        </div>

        @if ($faqs->isNotEmpty())
            <script type="application/ld+json">
                {!! json_encode([
                    '@@context' => 'https://schema.org',
                    '@type' => 'FAQPage',
                    'mainEntity' => $faqs->map(fn ($faq) => $faq->questionData())->all(),
                ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
            </script>
        @endif
    </section>

    <section class="closing-cta" data-reveal-group>
        @if ($images['faq_closing_cta_photo'] ?? null)
            <img class="closing-cta__photo" src="{{ asset('storage/' . $images['faq_closing_cta_photo']) }}" alt="">
        @endif
        <div class="closing-cta__scrim" aria-hidden="true"></div>
        <div class="container closing-cta__inner reveal">
            <h2>Vẫn còn thắc mắc? <span class="text-accent-free">Đăng ký học thử để được tư vấn</span></h2>
            <p class="closing-cta__note">Đội ngũ Alpha Kids sẽ giải đáp trực tiếp mọi câu hỏi của bạn khi đến buổi học
                thử.</p>
            <div class="closing-cta__actions">
                <a href="{{ route('registration.create') }}" class="btn btn--accent">Đăng ký học thử ngay</a>
            </div>
        </div>
    </section>

</div>
@endsection
