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
                                    alt="Huấn luyện viên khen ngợi học viên sau một pha xử lý tốt" loading="lazy">
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
                                    alt="Huấn luyện viên đặt câu hỏi gợi mở cho học viên trong buổi tập" loading="lazy">
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
                                    alt="Học viên lặp lại bài tập chạm bóng nhiều lần trên sân" loading="lazy">
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
                                    alt="Học viên vừa kỷ luật vừa vui vẻ trong buổi tập tại Alpha Kids" loading="lazy">
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

        <section class="section section--alt memo-section" id="weeklyMemo">
            <div class="container">
                <div class="section-head section-head--center">
                    <h2>Mỗi tuần một <span class="hl">ghi nhớ</span></h2>
                    <p>Song song với C.A.R.E, mỗi tuần Alpha Kids gửi một câu ghi nhớ ngắn, đại diện cho 1 trong 4 tư
                        duy nền tảng: giao tiếp, đánh giá, ứng xử, lãnh đạo. Không phải lý thuyết, là một câu trẻ nhớ
                        được và mang ra khỏi sân.</p>
                </div>

                <div class="memo-rows">
                    <div class="memo-row">
                        <div class="memo-row__icon">
                            <svg width="24" height="24" viewBox="0 0 256 256" f
                            ill="currentColor">
                                <path
                                    d="M128,24A104,104,0,0,0,36.18,176.88L24.83,210.93a16,16,0,0,0,20.24,20.24l34.05-11.35A104,104,0,1,0,128,24Zm0,192a87.87,87.87,0,0,1-44.06-11.81,8,8,0,0,0-6.54-.67L40,216,52.47,178.6a8,8,0,0,0-.66-6.54A88,88,0,1,1,128,216Z" />
                            </svg>
                        </div>
                        <div class="memo-row__body">
                            <h3 class="memo-row__title">01 · Tư duy giao tiếp</h3>
                            <p class="memo-row__mantra">Chào hỏi · Nói rõ · Lắng nghe</p>
                            <div class="memo-row__rule"></div>
                            <p class="memo-row__text">Trước mỗi buổi tập, huấn luyện viên Alpha Kids yêu cầu trẻ chào
                                đồng đội bằng tên, không phải một câu chào chung chung. Khi muốn đổi vị trí hay xin
                                bóng, trẻ phải nói thành lời, chỉ tay không được tính. Khi đồng đội đang nói, trẻ học
                                cách dừng lại nghe hết câu trước khi phản ứng.</p>
                        </div>
                        <div class="memo-row__note memo-row__note--a">
                            <div class="memo-row__note-card memo-row__note-card--back"></div>
                            <div class="memo-row__note-card memo-row__note-card--front">
                                <span class="memo-row__note-week">Tuần 01</span>
                                <span class="memo-row__note-mantra">Chào hỏi<br>Nói rõ<br>Lắng nghe</span>
                                <span class="memo-row__note-rule"></span>
                            </div>
                        </div>
                    </div>

                    <div class="memo-row">
                        <div class="memo-row__icon">
                            <svg width="24" height="24" viewBox="0 0 256 256" fill="currentColor">
                                <path
                                    d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z" />
                            </svg>
                        </div>
                        <div class="memo-row__body">
                            <h3 class="memo-row__title">02 · Tư duy đánh giá</h3>
                            <p class="memo-row__mantra">Quan sát trước · Suy nghĩ kỹ · Không đổ lỗi</p>
                            <div class="memo-row__rule"></div>
                            <p class="memo-row__text">Sau một pha bóng hỏng, câu đầu tiên huấn luyện viên hỏi không
                                phải "ai làm sai" mà là "con thấy gì trước khi mất bóng." Trẻ được dẫn để nhìn lại
                                tình huống bằng mắt mình trước, rồi mới đến phần rút kinh nghiệm. Đổ lỗi cho đồng đội
                                bị dừng ngay tại chỗ.</p>
                        </div>
                        <div class="memo-row__note memo-row__note--b">
                            <div class="memo-row__note-card memo-row__note-card--back"></div>
                            <div class="memo-row__note-card memo-row__note-card--front">
                                <span class="memo-row__note-week">Tuần 02</span>
                                <span class="memo-row__note-mantra">Quan sát trước<br>Suy nghĩ kỹ<br>Không đổ
                                    lỗi</span>
                                <span class="memo-row__note-rule"></span>
                            </div>
                        </div>
                    </div>

                    <div class="memo-row">
                        <div class="memo-row__icon">
                            <svg width="24" height="24" viewBox="0 0 256 256" fill="currentColor">
                                <path
                                    d="M178,40c-20.65,0-38.73,8.88-50,23.89C116.73,48.88,98.65,40,78,40a62.07,62.07,0,0,0-62,62c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,228.66,240,172,240,102A62.07,62.07,0,0,0,178,40ZM128,214.8C109.74,204.16,32,155.69,32,102A46.06,46.06,0,0,1,78,56c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,155.61,146.24,204.15,128,214.8Z" />
                            </svg>
                        </div>
                        <div class="memo-row__body">
                            <h3 class="memo-row__title">03 · Tư duy ứng xử</h3>
                            <p class="memo-row__mantra">Biết giúp đỡ · Biết chia sẻ · Biết tôn trọng</p>
                            <div class="memo-row__rule"></div>
                            <p class="memo-row__text">Một đồng đội ngã hay chuyền hỏng, huấn luyện viên quan sát ai là
                                người chạy tới trước: người trách móc hay người kéo bạn đứng dậy. Alpha Kids khen
                                công khai đứa trẻ chọn giúp đỡ, kể cả khi đội vừa mất điểm vì tình huống đó.</p>
                        </div>
                        <div class="memo-row__note memo-row__note--a">
                            <div class="memo-row__note-card memo-row__note-card--back"></div>
                            <div class="memo-row__note-card memo-row__note-card--front">
                                <span class="memo-row__note-week">Tuần 03</span>
                                <span class="memo-row__note-mantra">Biết giúp đỡ<br>Biết chia sẻ<br>Biết tôn
                                    trọng</span>
                                <span class="memo-row__note-rule"></span>
                            </div>
                        </div>
                    </div>

                    <div class="memo-row">
                        <div class="memo-row__icon">
                            <svg width="24" height="24" viewBox="0 0 256 256" fill="currentColor">
                                <path
                                    d="M42.76,50A8,8,0,0,0,40,56V224a8,8,0,0,0,16,0V179.77c26.79-21.16,49.87-9.75,76.45,3.41,16.4,8.11,34.06,16.85,53,16.85,13.93,0,28.54-4.75,43.82-18a8,8,0,0,0,2.76-6V56A8,8,0,0,0,218.76,50c-28,24.23-51.72,12.49-79.21-1.12C111.07,34.76,78.78,18.79,42.76,50ZM216,172.25c-26.79,21.16-49.87,9.74-76.45-3.41-25-12.35-52.81-26.13-83.55-8.4V59.79c26.79-21.16,49.87-9.75,76.45,3.4,25,12.35,52.82,26.13,83.55,8.4Z" />
                            </svg>
                        </div>
                        <div class="memo-row__body">
                            <h3 class="memo-row__title">04 · Tư duy lãnh đạo</h3>
                            <p class="memo-row__mantra">Dám làm · Kiên trì · Có trách nhiệm</p>
                            <div class="memo-row__rule"></div>
                            <p class="memo-row__text">Alpha Kids chưa vội gắn băng đội trưởng cho đứa trẻ nói to
                                nhất. Khi bóng đến chân ở tình huống khó, trẻ có dám nhận và xử lý, hay đẩy trách
                                nhiệm sang người khác, đó là điều được quan sát trước tiên. Dám thử, chấp nhận sai,
                                rồi quay lại làm tiếp.</p>
                        </div>
                        <div class="memo-row__note memo-row__note--b">
                            <div class="memo-row__note-card memo-row__note-card--back"></div>
                            <div class="memo-row__note-card memo-row__note-card--front">
                                <span class="memo-row__note-week">Tuần 04</span>
                                <span class="memo-row__note-mantra">Dám làm<br>Kiên trì<br>Có trách nhiệm</span>
                                <span class="memo-row__note-rule"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="closing-cta" data-reveal-group>
            @if ($images['method_closing_cta_photo'] ?? null)
                <img class="closing-cta__photo" src="{{ asset('storage/' . $images['method_closing_cta_photo']) }}"
                    alt="" loading="lazy">
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

@push('scripts')
    <script src="{{ asset('js/client/method.js') }}?v={{ filemtime(public_path('js/client/method.js')) }}"
        defer></script>
@endpush
