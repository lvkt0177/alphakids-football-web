@extends('layouts.client', [
    'title' => 'Câu hỏi thường gặp',
    'description' => 'Giải đáp các câu hỏi phụ huynh thường gặp về độ tuổi, học thử miễn phí, phương pháp C.A.R.E và hệ thống cơ sở của Alpha Kids Football Club.',
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/client/faq.css') }}?v={{ filemtime(public_path('css/client/faq.css')) }}">
@endpush

@section('content')
<div class="faq-page">

    <section class="page-hero">
        <div class="container">
            <h1>Câu hỏi <span class="hl">thường gặp</span></h1>
            <p>Những thắc mắc phụ huynh thường đặt ra trước khi đăng ký học thử tại Alpha Kids Football Club.</p>
        </div>
    </section>

    <section class="faq-body">
        <div class="container faq-body__inner">
            @if ($faqs->isNotEmpty())
                <div class="accordion accordion--boxed faq-body__accordion" data-accordion>
                    @foreach ($faqs as $index => $faq)
                        <div class="accordion-item" data-accordion-item>
                            <button type="button" class="accordion-item__trigger" data-accordion-trigger
                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="faqAnswer{{ $faq->id }}">
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

            <div class="faq-body__cta">
                <p>Không tìm thấy câu trả lời bạn cần?</p>
                <a href="{{ route('registration.create') }}" class="btn btn--accent">Đăng ký học thử để được tư vấn</a>
            </div>
        </div>
    </section>

</div>
@endsection
