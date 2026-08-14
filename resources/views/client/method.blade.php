@extends('layouts.client', [
    'title' => 'Phương pháp giáo dục',
    'description' => 'Phương pháp huấn luyện C.A.R.E và mô hình 4 tư duy cốt lõi tại Alpha Kids Football Club, giúp trẻ phát triển toàn diện cả về kỹ năng lẫn nhân cách.',
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/client/method.css') }}?v={{ filemtime(public_path('css/client/method.css')) }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/client/method.js') }}?v={{ filemtime(public_path('js/client/method.js')) }}" defer></script>
@endpush

@section('content')
<div class="method-page">

    <section class="page-hero @if ($images['method_banner'] ?? null) page-hero--photo @endif">
        @if ($images['method_banner'] ?? null)
            <div class="page-hero__photo" aria-hidden="true">
                <img src="{{ asset('storage/' . $images['method_banner']) }}" alt="">
            </div>
            <div class="page-hero__scrim" aria-hidden="true"></div>
        @endif
        <div class="container">
            <h1>Phương pháp <span class="hl">giáo dục</span></h1>
            <p>Phương pháp giáo dục hiện đại, kết hợp thể thao và phát triển tư duy cho trẻ.</p>
        </div>
    </section>

    <section class="section section--alt" data-reveal-group>
        <div class="container">
            <div class="section-head section-head--center reveal">
                <h2>Nền tảng phương pháp giáo dục của <span class="hl">Alpha Kids</span></h2>
                <p>Mọi buổi học tại Alpha Kids Football Club được xây dựng trên 2 nền tảng cốt lõi nhằm phát triển trẻ một cách toàn diện và bền vững.</p>
            </div>
            <div class="value-pair">
                <div class="value-pair__card reveal reveal-d1">
                    <div class="icon-roundel">
                        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="12" r="4" /><circle cx="16" cy="12" r="4" /></svg>
                    </div>
                    <h3>Phương pháp C.A.R.E</h3>
                    <div class="value-pair__rule"></div>
                    <p>Phương pháp huấn luyện tập trung vào việc tạo động lực, khuyến khích tư duy, rèn luyện thói quen tích cực và giúp trẻ yêu thích việc học thông qua trải nghiệm trên sân cỏ.</p>
                </div>
                <div class="value-pair__card reveal reveal-d2">
                    <div class="icon-roundel">
                        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18h6M10 21h4M12 3a6 6 0 0 0-6 6c0 2.5 1.5 4 2.5 5s1.5 1.5 1.5 3h4c0-1.5.5-2 1.5-3s2.5-2.5 2.5-5a6 6 0 0 0-6-6z" /></svg>
                    </div>
                    <h3>Mô hình 4 tư duy</h3>
                    <div class="value-pair__rule"></div>
                    <p>Phát triển 4 nhóm tư duy cốt lõi giúp trẻ hình thành kỹ năng sống, khả năng thích nghi và tư duy tích cực trong học tập và cuộc sống.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section" data-reveal-group>
        <div class="container">
            <div class="section-head section-head--center reveal">
                <h2>Phương pháp huấn luyện <span class="hl">C.A.R.E</span></h2>
                <p>C.A.R.E là kim chỉ nam trong mọi hoạt động huấn luyện tại Alpha Kids. Chúng tôi không chỉ dạy bóng đá, chúng tôi giúp trẻ trở thành phiên bản tốt hơn mỗi ngày.</p>
            </div>
            <div class="care-detail-grid">
                <div class="care-detail-card reveal reveal-d1">
                    <div class="care-detail-card__body">
                        <div class="care-detail-card__letter">C</div>
                        <h4>CELEBRATE</h4>
                        <span class="care-detail-card__subtitle">Công nhận, khen ngợi</span>
                        <p>Công nhận và khích lệ nỗ lực, tinh thần hợp tác và ý thức tốt dù nhỏ nhất để tạo động lực.</p>
                    </div>
                    <div class="care-detail-card__media">
                        @if ($images['method_care_celebrate'] ?? null)
                            <img src="{{ asset('storage/' . $images['method_care_celebrate']) }}" alt="">
                        @else
                            <div class="care-detail-card__media-empty">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><rect x="3" y="5" width="18" height="14" rx="2" /><circle cx="9" cy="10.5" r="1.6" /><path d="M21 16l-5.5-5.5L9 17" /></svg>
                                <span>Chưa có ảnh</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="care-detail-card reveal reveal-d2">
                    <div class="care-detail-card__body">
                        <div class="care-detail-card__letter">A</div>
                        <h4>ASK &amp; ANSWER</h4>
                        <span class="care-detail-card__subtitle">Hỏi, gợi mở</span>
                        <p>Hỏi gợi mở bằng câu hỏi thay vì ra lệnh, tập khả năng suy nghĩ, phán đoán và tự tìm ra giải pháp.</p>
                    </div>
                    <div class="care-detail-card__media">
                        @if ($images['method_care_ask_answer'] ?? null)
                            <img src="{{ asset('storage/' . $images['method_care_ask_answer']) }}" alt="">
                        @else
                            <div class="care-detail-card__media-empty">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><rect x="3" y="5" width="18" height="14" rx="2" /><circle cx="9" cy="10.5" r="1.6" /><path d="M21 16l-5.5-5.5L9 17" /></svg>
                                <span>Chưa có ảnh</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="care-detail-card reveal reveal-d3">
                    <div class="care-detail-card__body">
                        <div class="care-detail-card__letter">R</div>
                        <h4>REPETITION</h4>
                        <span class="care-detail-card__subtitle">Lặp lại, liên tục</span>
                        <p>Duy trì nhịp độ nhanh và liên tục, áp lực vừa đủ để trẻ tập trung tối đa và ghi nhớ lâu hơn.</p>
                    </div>
                    <div class="care-detail-card__media">
                        @if ($images['method_care_repetition'] ?? null)
                            <img src="{{ asset('storage/' . $images['method_care_repetition']) }}" alt="">
                        @else
                            <div class="care-detail-card__media-empty">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><rect x="3" y="5" width="18" height="14" rx="2" /><circle cx="9" cy="10.5" r="1.6" /><path d="M21 16l-5.5-5.5L9 17" /></svg>
                                <span>Chưa có ảnh</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="care-detail-card reveal reveal-d4">
                    <div class="care-detail-card__body">
                        <div class="care-detail-card__letter">E</div>
                        <h4>ENJOY &amp; STRICT</h4>
                        <span class="care-detail-card__subtitle">Nghiêm, vui</span>
                        <p>Nghiêm trong kỷ luật, vui trong trải nghiệm để tạo niềm vui từ việc tự cảm nhận tiến bộ.</p>
                    </div>
                    <div class="care-detail-card__media">
                        @if ($images['method_care_enjoy_strict'] ?? null)
                            <img src="{{ asset('storage/' . $images['method_care_enjoy_strict']) }}" alt="">
                        @else
                            <div class="care-detail-card__media-empty">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><rect x="3" y="5" width="18" height="14" rx="2" /><circle cx="9" cy="10.5" r="1.6" /><path d="M21 16l-5.5-5.5L9 17" /></svg>
                                <span>Chưa có ảnh</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section--alt" data-reveal-group>
        <div class="container">
            <div class="section-head section-head--center reveal">
                <h2>Mô hình 4 tư duy phát triển <span class="hl">toàn diện</span></h2>
                <p>4 nhóm tư duy được lồng ghép trong mọi bài học và hoạt động, giúp trẻ hình thành nền tảng vững chắc cho tương lai.</p>
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
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5h16a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H9l-4 4v-4H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1z" /></svg>
                    </div>
                    <h4>Tư duy giao tiếp</h4>
                    <p>Biết lắng nghe, diễn đạt và hợp tác hiệu quả. Trẻ học cách chia sẻ ý tưởng rõ ràng và phối hợp ăn ý cùng đồng đội trên sân.</p>
                </div>

                <div class="pillar-card" data-pillar-card>
                    <span class="pillar-card__ghost" aria-hidden="true">02</span>
                    <div class="pillar-card__icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.8-6.2 10-6.2S22 12 22 12s-3.8 6.2-10 6.2S2 12 2 12z" /><circle cx="12" cy="12" r="3" /></svg>
                    </div>
                    <h4>Tư duy đánh giá</h4>
                    <p>Biết quan sát, phân tích và đưa ra quyết định. Mỗi tình huống trên sân là một bài học về nhìn nhận đúng sai và chọn hướng xử lý phù hợp.</p>
                </div>

                <div class="pillar-card" data-pillar-card>
                    <span class="pillar-card__ghost" aria-hidden="true">03</span>
                    <div class="pillar-card__icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="12" r="6" /><circle cx="15" cy="12" r="6" /></svg>
                    </div>
                    <h4>Tư duy ứng xử</h4>
                    <p>Biết tôn trọng, hỗ trợ và giải quyết vấn đề. Trẻ rèn thói quen ứng xử đúng mực với đồng đội, đối thủ và trọng tài trong mọi tình huống.</p>
                </div>

                <div class="pillar-card" data-pillar-card>
                    <span class="pillar-card__ghost" aria-hidden="true">04</span>
                    <div class="pillar-card__icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M5 3v18" /><path d="M5 4h13l-3 4 3 4H5" /></svg>
                    </div>
                    <h4>Tư duy lãnh đạo</h4>
                    <p>Biết chịu trách nhiệm, truyền cảm hứng và dẫn dắt đội nhóm. Từ vai trò nhỏ nhất trên sân, trẻ học cách làm gương và dẫn dắt tập thể tiến lên.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section" data-reveal-group>
        <div class="container">
            <div class="heart-banner reveal">
                <div class="heart-banner__text">
                    <h2>Giáo dục bằng <span class="heart-banner__hl">trái tim</span><br>Huấn luyện bằng <span class="heart-banner__hl">tri thức</span></h2>
                    <p>Chúng tôi luôn đặt sự phát triển của trẻ làm trung tâm, kết hợp giữa chuyên môn huấn luyện và phương pháp giáo dục hiện đại để mỗi buổi tập là một trải nghiệm ý nghĩa và đáng nhớ.</p>
                    <div class="heart-banner__values">
                        <div class="heart-banner__value">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6z" /></svg>
                            <span>Kỷ luật</span>
                        </div>
                        <div class="heart-banner__value">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M7 12l3 3 7-7" /></svg>
                            <span>Tôn trọng</span>
                        </div>
                        <div class="heart-banner__value">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3" /></svg>
                            <span>Nỗ lực</span>
                        </div>
                        <div class="heart-banner__value">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3" /><circle cx="17" cy="9" r="2.6" /></svg>
                            <span>Đoàn kết</span>
                        </div>
                        <div class="heart-banner__value">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17l6-6 4 4 8-8" /></svg>
                            <span>Tiến bộ</span>
                        </div>
                    </div>
                </div>
                <div class="heart-banner__media" aria-hidden="true">
                    @if ($images['method_heart_banner'] ?? null)
                        <img src="{{ asset('storage/' . $images['method_heart_banner']) }}" alt="">
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="closing-cta" data-reveal-group>
        @if ($images['method_closing_cta_photo'] ?? null)
            <img class="closing-cta__photo" src="{{ asset('storage/' . $images['method_closing_cta_photo']) }}" alt="">
        @endif
        <div class="closing-cta__scrim" aria-hidden="true"></div>
        <div class="container closing-cta__inner reveal">
            <h2>Đồng hành cùng con trên <span class="text-accent-free">hành trình trưởng thành</span></h2>
            <p class="closing-cta__note">Đăng ký buổi học thử để trải nghiệm phương pháp giáo dục khác biệt tại Alpha Kids Football Club.</p>
            <div class="closing-cta__actions">
                <a href="{{ route('registration.create') }}" class="btn btn--accent">Đăng ký học thử ngay</a>
            </div>
        </div>
    </section>

</div>
@endsection
