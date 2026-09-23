@extends('layouts.client', [
    'titleFull' => 'Chính sách bảo mật dữ liệu cá nhân | Alpha Kids',
    'description' => 'Chính sách bảo mật và bảo vệ dữ liệu cá nhân của Alpha Kids Football Club: thông tin thu thập, mục đích sử dụng và quyền của phụ huynh, học viên.',
])

@push('styles')
    <link rel="stylesheet"
        href="{{ asset('css/client/policy.css') }}?v={{ filemtime(public_path('css/client/policy.css')) }}">
@endpush

@section('content')
<div class="policy-page">
    <div class="container policy-shell">

        <header class="policy-header reveal">
            <h1>Chính sách bảo mật <span class="hl">và bảo vệ dữ liệu cá nhân</span></h1>
            <p>Alpha Kids Football Club cam kết bảo vệ thông tin cá nhân của phụ huynh và học viên theo đúng quy định pháp luật Việt Nam về bảo vệ dữ liệu cá nhân.</p>
        </header>

        <div class="policy-layout">

            <aside class="policy-toc reveal" aria-label="Mục lục">
                <span class="policy-toc__label">Nội dung chính sách</span>
                <ol>
                    <li><a href="#thong-tin-thu-thap">Thông tin chúng tôi thu thập</a></li>
                    <li><a href="#muc-dich-su-dung">Mục đích sử dụng thông tin</a></li>
                    <li><a href="#thong-tin-tre-em">Thông tin về trẻ em</a></li>
                    <li><a href="#hinh-anh-video">Hình ảnh và video của học viên</a></li>
                    <li><a href="#chia-se-ben-thu-ba">Chia sẻ thông tin với bên thứ ba</a></li>
                    <li><a href="#bao-mat-luu-tru">Bảo mật và lưu trữ thông tin</a></li>
                    <li><a href="#quyen-phu-huynh">Quyền của phụ huynh</a></li>
                    <li><a href="#cookie">Cookie và dữ liệu kỹ thuật</a></li>
                    <li><a href="#lien-ket-ngoai">Liên kết đến website bên ngoài</a></li>
                    <li><a href="#thay-doi-chinh-sach">Thay đổi chính sách bảo mật</a></li>
                    <li><a href="#lien-he">Thông tin liên hệ</a></li>
                </ol>
            </aside>

            <div class="policy-content reveal reveal-d1">
                <p class="policy-updated">Ngày cập nhật: <strong>23/09/2026</strong></p>

                <p>Alpha Kids Football Club (<strong>"Alpha Kids"</strong>, <strong>"chúng tôi"</strong>) tôn trọng quyền riêng tư và cam kết bảo vệ thông tin cá nhân của phụ huynh, học viên và khách truy cập website, phù hợp với Luật Bảo vệ dữ liệu cá nhân và các quy định pháp luật hiện hành của Việt Nam.</p>

                <p>Chính sách này giải thích cách Alpha Kids thu thập, sử dụng, lưu trữ và bảo vệ thông tin cá nhân khi phụ huynh hoặc khách hàng sử dụng website, đăng ký học, đăng ký học thử hoặc liên hệ với Alpha Kids.</p>

                <h2 id="thong-tin-thu-thap"><span class="policy-num">1.</span> Thông tin chúng tôi thu thập</h2>
                <p>Tùy theo mục đích sử dụng dịch vụ, Alpha Kids có thể thu thập một số thông tin sau:</p>

                <h3><span class="policy-num policy-num--sub">1.1.</span> Thông tin của phụ huynh/người đăng ký</h3>
                <ul>
                    <li>Họ và tên;</li>
                    <li>Số điện thoại;</li>
                    <li>Khu vực/địa chỉ liên hệ;</li>
                    <li>Thông tin liên quan đến nhu cầu đăng ký học;</li>
                    <li>Nội dung trao đổi hoặc yêu cầu được gửi thông qua website.</li>
                </ul>

                <h3><span class="policy-num policy-num--sub">1.2.</span> Thông tin của học viên</h3>
                <p>Khi phụ huynh đăng ký cho trẻ tham gia chương trình, Alpha Kids có thể thu thập:</p>
                <ul>
                    <li>Họ và tên học viên;</li>
                    <li>Năm sinh/độ tuổi;</li>
                    <li>Giới tính nếu cần thiết cho việc quản lý lớp;</li>
                    <li>Cơ sở/lớp học đăng ký;</li>
                    <li>Thông tin cần thiết khác liên quan trực tiếp đến việc tổ chức và quản lý hoạt động đào tạo.</li>
                </ul>
                <p>Alpha Kids chỉ thu thập những thông tin cần thiết cho mục đích cung cấp và quản lý dịch vụ.</p>

                <h2 id="muc-dich-su-dung"><span class="policy-num">2.</span> Mục đích sử dụng thông tin</h2>
                <p>Thông tin được cung cấp có thể được Alpha Kids sử dụng để:</p>
                <ul>
                    <li>Tiếp nhận và xử lý yêu cầu đăng ký học;</li>
                    <li>Liên hệ với phụ huynh để tư vấn chương trình;</li>
                    <li>Xếp lớp và quản lý học viên;</li>
                    <li>Thông báo lịch học, lịch nghỉ, thay đổi sân hoặc các thông tin liên quan đến lớp học;</li>
                    <li>Quản lý học phí và các dịch vụ liên quan;</li>
                    <li>Chăm sóc phụ huynh và học viên;</li>
                    <li>Tổ chức các hoạt động, sự kiện, giao lưu bóng đá;</li>
                    <li>Cải thiện chất lượng chương trình và trải nghiệm sử dụng website;</li>
                    <li>Thực hiện các nghĩa vụ pháp lý hoặc yêu cầu hợp pháp của cơ quan có thẩm quyền khi cần thiết.</li>
                </ul>
                <p>Alpha Kids không sử dụng thông tin cá nhân cho những mục đích không phù hợp với nội dung mà phụ huynh đã cung cấp hoặc cho phép, trừ trường hợp pháp luật có quy định khác.</p>

                <h2 id="thong-tin-tre-em"><span class="policy-num">3.</span> Thông tin về trẻ em</h2>
                <p>Alpha Kids nhận thức rằng thông tin liên quan đến trẻ em dưới 16 tuổi cần được bảo vệ đặc biệt theo quy định pháp luật.</p>
                <p>Việc cung cấp thông tin của học viên là trẻ em được thực hiện bởi phụ huynh hoặc người đại diện hợp pháp của trẻ. Phụ huynh/người đại diện hợp pháp có trách nhiệm đảm bảo rằng việc cung cấp thông tin của trẻ cho Alpha Kids là phù hợp với quy định pháp luật.</p>
                <p>Alpha Kids chỉ sử dụng thông tin của học viên trong phạm vi cần thiết cho việc đăng ký, tổ chức lớp học, quản lý học viên, chăm sóc học viên và các hoạt động liên quan đến chương trình, luôn đặt lợi ích tốt nhất của trẻ lên hàng đầu.</p>

                <h2 id="hinh-anh-video"><span class="policy-num">4.</span> Hình ảnh và video của học viên</h2>
                <p>Trong quá trình tổ chức lớp học, hoạt động giao lưu hoặc sự kiện, Alpha Kids có thể ghi hình, chụp ảnh để phục vụ việc lưu trữ hoạt động và truyền thông của câu lạc bộ.</p>
                <p>Việc sử dụng hình ảnh, video của học viên cho mục đích truyền thông công khai như website, Facebook, TikTok hoặc các kênh truyền thông chính thức của Alpha Kids sẽ được thực hiện theo quy định pháp luật và sự đồng ý phù hợp của phụ huynh/người đại diện hợp pháp khi cần thiết.</p>
                <p>Phụ huynh có thể liên hệ Alpha Kids theo thông tin tại <a href="#lien-he">mục 11</a> nếu có yêu cầu liên quan đến việc sử dụng hình ảnh của học viên.</p>

                <h2 id="chia-se-ben-thu-ba"><span class="policy-num">5.</span> Chia sẻ thông tin với bên thứ ba</h2>
                <p>Alpha Kids không bán, cho thuê hoặc trao đổi thông tin cá nhân của phụ huynh/học viên cho bên thứ ba nhằm mục đích thương mại trái phép.</p>
                <p>Thông tin có thể được cung cấp cho bên thứ ba trong phạm vi cần thiết để vận hành dịch vụ, chẳng hạn như:</p>
                <ul>
                    <li>Đơn vị cung cấp dịch vụ website, hosting hoặc hệ thống quản lý;</li>
                    <li>Đơn vị cung cấp giải pháp thanh toán hoặc hóa đơn điện tử khi cần thiết;</li>
                    <li>Đơn vị cung cấp các dịch vụ công nghệ hỗ trợ hoạt động của Alpha Kids;</li>
                    <li>Cơ quan nhà nước có thẩm quyền khi có yêu cầu hợp pháp.</li>
                </ul>
                <p>Các bên được tiếp cận thông tin có trách nhiệm bảo vệ thông tin theo quy định áp dụng và trong phạm vi công việc được giao.</p>

                <h2 id="bao-mat-luu-tru"><span class="policy-num">6.</span> Bảo mật và lưu trữ thông tin</h2>
                <p>Alpha Kids áp dụng các biện pháp phù hợp để bảo vệ thông tin cá nhân khỏi việc truy cập, sử dụng, tiết lộ, thay đổi hoặc mất mát trái phép.</p>
                <p>Thông tin được lưu trữ trong khoảng thời gian cần thiết để thực hiện mục đích thu thập, cung cấp dịch vụ, quản lý học viên và đáp ứng các nghĩa vụ pháp lý liên quan. Khi thông tin không còn cần thiết, Alpha Kids sẽ xem xét việc xóa, hủy hoặc ẩn danh thông tin theo quy định và điều kiện thực tế.</p>
                <p>Tuy nhiên, không có phương thức truyền tải hoặc lưu trữ dữ liệu trên Internet nào có thể đảm bảo an toàn tuyệt đối.</p>

                <h2 id="quyen-phu-huynh"><span class="policy-num">7.</span> Quyền của phụ huynh và người cung cấp thông tin</h2>
                <p>Trong phạm vi pháp luật cho phép, phụ huynh/người cung cấp thông tin có thể yêu cầu:</p>
                <ul>
                    <li>Biết về việc thông tin cá nhân của mình được thu thập và sử dụng;</li>
                    <li>Kiểm tra hoặc yêu cầu cung cấp thông tin cá nhân liên quan;</li>
                    <li>Yêu cầu chỉnh sửa thông tin không chính xác;</li>
                    <li>Yêu cầu xóa hoặc hạn chế xử lý thông tin trong trường hợp phù hợp;</li>
                    <li>Rút lại sự đồng ý đối với việc xử lý dữ liệu khi pháp luật cho phép;</li>
                    <li>Khiếu nại hoặc phản ánh về việc xử lý dữ liệu cá nhân.</li>
                </ul>
                <p>Mọi yêu cầu có thể được gửi đến Alpha Kids thông qua thông tin liên hệ tại <a href="#lien-he">mục 11</a> của chính sách này.</p>

                <h2 id="cookie"><span class="policy-num">8.</span> Cookie và dữ liệu kỹ thuật</h2>
                <p>Cookie là một đoạn dữ liệu nhỏ được lưu tạm trên trình duyệt khi bạn truy cập website, giúp trang web ghi nhớ một số thông tin kỹ thuật để hoạt động đúng (ví dụ: không bị mất dữ liệu đang điền dở khi chuyển trang).</p>
                <p>Hiện tại, website Alpha Kids chỉ dùng loại cookie cần thiết này để website chạy đúng chức năng — <strong>không</strong> dùng cookie để theo dõi hành vi, không hiển thị quảng cáo, và chưa gắn công cụ đo lường lượt truy cập nào (như Google Analytics, Facebook Pixel...).</p>
                <p>Nếu sau này Alpha Kids sử dụng thêm các công cụ như vậy, chính sách này sẽ được cập nhật để thông báo trước. Bạn có thể tắt cookie trong trình duyệt của mình bất cứ lúc nào; tuy nhiên nếu tắt cookie cần thiết, một số chức năng như điền form đăng ký có thể không hoạt động đúng.</p>

                <h2 id="lien-ket-ngoai"><span class="policy-num">9.</span> Liên kết đến website bên ngoài</h2>
                <p>Website Alpha Kids có thể chứa liên kết đến các website hoặc nền tảng của bên thứ ba. Alpha Kids không chịu trách nhiệm về nội dung hoặc chính sách bảo mật của những website bên ngoài này. Phụ huynh nên đọc chính sách bảo mật của từng nền tảng trước khi cung cấp thông tin cá nhân.</p>

                <h2 id="thay-doi-chinh-sach"><span class="policy-num">10.</span> Thay đổi chính sách bảo mật</h2>
                <p>Alpha Kids có thể cập nhật Chính sách bảo mật này khi cần thiết để phù hợp với thay đổi trong hoạt động của câu lạc bộ, công nghệ hoặc quy định pháp luật.</p>
                <p>Phiên bản cập nhật sẽ được đăng tải trên website. Việc tiếp tục sử dụng website sau khi chính sách được cập nhật có thể được xem là việc người dùng đã tiếp cận nội dung chính sách mới, trong phạm vi pháp luật cho phép.</p>

                <h2 id="lien-he"><span class="policy-num">11.</span> Thông tin liên hệ</h2>
                <p>Nếu phụ huynh có câu hỏi, yêu cầu hoặc phản ánh liên quan đến việc bảo vệ dữ liệu cá nhân, vui lòng liên hệ:</p>

                <div class="policy-contact">
                    <p class="policy-contact__name">CÔNG TY TNHH ALPHA KIDS FOOTBALL CLUB</p>
                    <p>Địa chỉ: 63 Quốc lộ 20, xã Đức Trọng, tỉnh Lâm Đồng</p>
                    <p>Điện thoại: <a href="tel:0974895917">0974 895 917</a></p>
                </div>

                <p>Alpha Kids sẽ tiếp nhận và xử lý các yêu cầu liên quan đến dữ liệu cá nhân trong phạm vi trách nhiệm của mình.</p>
            </div>

        </div>
    </div>
</div>
@endsection
