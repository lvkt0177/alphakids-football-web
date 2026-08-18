@extends('layouts.client', [
    'title' => 'Phương pháp giáo dục',
    'description' => 'Phương pháp huấn luyện C.A.R.E tại Alpha Kids Football Club: khích lệ, đặt câu hỏi, lặp lại và kỷ luật đi cùng niềm vui, giúp trẻ phát triển toàn diện.',
])

@push('styles')
    <link rel="stylesheet"
        href="{{ asset('css/client/method.css') }}?v={{ filemtime(public_path('css/client/method.css')) }}">
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
                    <p>Mọi buổi học tại Alpha Kids Football Club được xây dựng trên 2 nền tảng cốt lõi nhằm phát triển trẻ
                        một cách toàn diện và bền vững.</p>
                </div>
                <div class="value-pair">
                    <div class="value-pair__card reveal reveal-d1">
                        <div class="icon-roundel">
                            <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="8" cy="12" r="4" />
                                <circle cx="16" cy="12" r="4" />
                            </svg>
                        </div>
                        <h3>Phương pháp C.A.R.E</h3>
                        <div class="value-pair__rule"></div>
                        <p>Phương pháp huấn luyện xoay quanh 4 chữ C.A.R.E: khích lệ đúng lúc, đặt câu hỏi gợi mở, lặp lại
                            có chủ đích, và giữ kỷ luật đi cùng niềm vui trong từng buổi tập trên sân cỏ.</p>
                    </div>
                    <div class="value-pair__card reveal reveal-d2">
                        <div class="icon-roundel">
                            <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M9 18h6M10 21h4M12 3a6 6 0 0 0-6 6c0 2.5 1.5 4 2.5 5s1.5 1.5 1.5 3h4c0-1.5.5-2 1.5-3s2.5-2.5 2.5-5a6 6 0 0 0-6-6z" />
                            </svg>
                        </div>
                        <h3>Mô hình 4 tư duy</h3>
                        <div class="value-pair__rule"></div>
                        <p>4 nhóm tư duy giao tiếp, đánh giá, ứng xử và lãnh đạo được lồng ghép trong mọi buổi tập, giúp
                            trẻ hình thành kỹ năng sống và khả năng thích nghi. <a href="{{ route('about') }}#pillarBento"
                                class="inline-link">Xem chi tiết tại trang Về CLB</a>.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" data-reveal-group>
            <div class="container">
                <div class="section-head section-head--center reveal">
                    <h2>Phương pháp huấn luyện <span class="hl">C.A.R.E</span></h2>
                    <p>C.A.R.E là 4 nguyên tắc huấn luyện viên Alpha Kids áp dụng trong từng buổi tập. Dưới đây là cách
                        mỗi nguyên tắc được thực hiện thật trên sân, không phải lý thuyết chung chung.</p>
                </div>
                <div class="care-detail-grid">
                    <div class="care-detail-card reveal reveal-d1">
                        <div class="care-detail-card__body">
                            <div class="care-detail-card__letter">C</div>
                            <h3>CELEBRATE</h3>
                            <span class="care-detail-card__subtitle">Công nhận, khích lệ</span>
                            <p class="care-detail-card__lead">Ở Alpha Kids, một buổi tập tốt được đo bằng nỗ lực bỏ ra,
                                không phải bàn thắng ghi được.</p>
                            <p class="care-detail-card__text">Một đường chuyền đúng hướng, một lần đứng dậy thử lại sau cú
                                vấp, một lần nhường bóng cho đồng đội đang trống trải, huấn luyện viên đều dừng lại và ghi
                                nhận ngay tại chỗ. Trẻ cần nghe điều đó đúng lúc, ngay khi vừa làm xong, để hiểu rằng cố
                                gắng của mình có ý nghĩa thật, chứ không phải chỉ là lời động viên chung chung của người
                                lớn.</p>
                            <div class="care-detail-card__punch-rule"></div>
                            <p class="care-detail-card__punch">
                                <span>Khích lệ ở Alpha Kids không đợi đến cuối buổi hay đợi trẻ thắng.</span>
                                <span>Chúng tôi khen ngay lúc trẻ đang cố hết sức, kể cả khi kết quả chưa được như ý.</span>
                            </p>
                        </div>
                        <div class="care-detail-card__media">
                            @if ($images['method_care_celebrate'] ?? null)
                                <img src="{{ asset('storage/' . $images['method_care_celebrate']) }}"
                                    alt="Huấn luyện viên khen ngợi học viên sau một pha xử lý tốt">
                            @else
                                <div class="care-detail-card__media-empty">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3">
                                        <rect x="3" y="5" width="18" height="14" rx="2" />
                                        <circle cx="9" cy="10.5" r="1.6" />
                                        <path d="M21 16l-5.5-5.5L9 17" />
                                    </svg>
                                    <span>Chưa có ảnh</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="care-detail-card reveal reveal-d2">
                        <div class="care-detail-card__body">
                            <div class="care-detail-card__letter">A</div>
                            <h3>ASK &amp; ANSWER</h3>
                            <span class="care-detail-card__subtitle">Hỏi, gợi mở</span>
                            <p class="care-detail-card__lead">Huấn luyện viên ở Alpha Kids ít khi nói thẳng cho trẻ biết
                                phải làm gì tiếp theo. Thay vào đó là một câu hỏi, ngay giữa buổi tập, ngay khi tình huống
                                vừa xảy ra.</p>
                            <ul class="care-detail-card__list">
                                <li>&ldquo;Con thấy khoảng trống ở đâu?&rdquo;</li>
                                <li>&ldquo;Nếu đồng đội đang bị kèm thì con có thể làm gì?&rdquo;</li>
                                <li>&ldquo;Lần vừa rồi con làm gì chưa tốt, con muốn thử lại thế nào?&rdquo;</li>
                            </ul>
                            <p class="care-detail-card__text">Cách hỏi này buộc trẻ phải tự nhìn lại tình huống, tự chọn
                                hướng xử lý, rồi tự chịu trách nhiệm với lựa chọn đó, ba bước mà một câu trả lời có sẵn
                                không bao giờ dạy được.</p>
                            <div class="care-detail-card__punch-rule"></div>
                            <p class="care-detail-card__punch">
                                <span>Một cầu thủ giỏi kỹ thuật chưa chắc đọc được trận đấu.</span>
                                <span>C.A.R.E nhắm vào đúng phần đó.</span>
                            </p>
                        </div>
                        <div class="care-detail-card__media">
                            @if ($images['method_care_ask_answer'] ?? null)
                                <img src="{{ asset('storage/' . $images['method_care_ask_answer']) }}"
                                    alt="Huấn luyện viên đặt câu hỏi gợi mở cho học viên trong buổi tập">
                            @else
                                <div class="care-detail-card__media-empty">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3">
                                        <rect x="3" y="5" width="18" height="14" rx="2" />
                                        <circle cx="9" cy="10.5" r="1.6" />
                                        <path d="M21 16l-5.5-5.5L9 17" />
                                    </svg>
                                    <span>Chưa có ảnh</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="care-detail-card reveal reveal-d3">
                        <div class="care-detail-card__body">
                            <div class="care-detail-card__letter">R</div>
                            <h3>REPETITION</h3>
                            <span class="care-detail-card__subtitle">Lặp lại, liên tục</span>
                            <p class="care-detail-card__lead">Kỹ năng chỉ trở thành phản xạ khi được lặp lại đủ nhiều,
                                trong đủ nhiều tình huống khác nhau, không phải chỉ đúng một lần trong một bài tập mẫu.</p>
                            <p class="care-detail-card__text">Vì vậy các bài tập tại Alpha Kids được xếp với nhịp độ liên
                                tục: nhiều lần chạm bóng trong một buổi, độ khó tăng dần theo từng độ tuổi, và tình huống
                                lặp lại dưới nhiều biến thể khác nhau thay vì lặp y hệt nhau. Trẻ xử lý cùng một dạng bóng
                                nhiều lần đến mức không còn phải nghĩ, chân tự biết làm gì trước, đầu mới theo sau.</p>
                            <div class="care-detail-card__punch-rule"></div>
                            <p class="care-detail-card__punch">
                                <span>Học một kỹ thuật và làm chủ được nó trên sân là hai việc khác nhau.</span>
                                <span>Lặp lại chính là khoảng cách nối liền hai điều đó.</span>
                            </p>
                        </div>
                        <div class="care-detail-card__media">
                            @if ($images['method_care_repetition'] ?? null)
                                <img src="{{ asset('storage/' . $images['method_care_repetition']) }}"
                                    alt="Học viên lặp lại bài tập chạm bóng nhiều lần trên sân">
                            @else
                                <div class="care-detail-card__media-empty">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3">
                                        <rect x="3" y="5" width="18" height="14" rx="2" />
                                        <circle cx="9" cy="10.5" r="1.6" />
                                        <path d="M21 16l-5.5-5.5L9 17" />
                                    </svg>
                                    <span>Chưa có ảnh</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="care-detail-card reveal reveal-d4">
                        <div class="care-detail-card__body">
                            <div class="care-detail-card__letter">E</div>
                            <h3>ENJOY &amp; STRICT</h3>
                            <span class="care-detail-card__subtitle">Kỷ luật, niềm vui</span>
                            <p class="care-detail-card__lead">Một buổi tập ở Alpha Kids có khung giờ rõ ràng, có quy tắc
                                rõ ràng, và có huấn luyện viên nhắc nhở khi trẻ mất tập trung hoặc thiếu tôn trọng đồng
                                đội.</p>
                            <p class="care-detail-card__text">Nhưng trong khung đó, trẻ được tự do thử, tự do sai, tự do
                                thể hiện theo cách của riêng mình. Hai điều này không mâu thuẫn nhau. Kỷ luật là cái khung
                                giữ cho buổi tập không tan rã, niềm vui là thứ khiến trẻ muốn quay lại vào tuần sau. Một
                                buổi tập tốt không phải là buổi tập mà trẻ chỉ chơi thật vui, mà là buổi tập khiến trẻ vui
                                vì vừa tự mình làm được điều mà tuần trước còn chưa làm được.</p>
                            <div class="care-detail-card__punch-rule"></div>
                            <p class="care-detail-card__punch">
                                <span>Nghiêm túc trong kỷ luật.</span>
                                <span>Tích cực trong trải nghiệm.</span>
                                <span>Hạnh phúc trong sự tiến bộ.</span>
                            </p>
                        </div>
                        <div class="care-detail-card__media">
                            @if ($images['method_care_enjoy_strict'] ?? null)
                                <img src="{{ asset('storage/' . $images['method_care_enjoy_strict']) }}"
                                    alt="Học viên vừa kỷ luật vừa vui vẻ trong buổi tập tại Alpha Kids">
                            @else
                                <div class="care-detail-card__media-empty">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3">
                                        <rect x="3" y="5" width="18" height="14" rx="2" />
                                        <circle cx="9" cy="10.5" r="1.6" />
                                        <path d="M21 16l-5.5-5.5L9 17" />
                                    </svg>
                                    <span>Chưa có ảnh</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="closing-cta" data-reveal-group>
            @if ($images['method_closing_cta_photo'] ?? null)
                <img class="closing-cta__photo" src="{{ asset('storage/' . $images['method_closing_cta_photo']) }}"
                    alt="">
            @endif
            <div class="closing-cta__scrim" aria-hidden="true"></div>
            <div class="container closing-cta__inner reveal">
                <h2>Đồng hành cùng con trên <span class="text-accent-free">hành trình trưởng thành</span></h2>
                <p class="closing-cta__note">Đăng ký buổi học thử để trải nghiệm phương pháp giáo dục khác biệt tại Alpha
                    Kids Football Club.</p>
                <div class="closing-cta__actions">
                    <a href="{{ route('registration.create') }}" class="btn btn--accent">Đăng ký học thử ngay</a>
                </div>
            </div>
        </section>

    </div>
@endsection
