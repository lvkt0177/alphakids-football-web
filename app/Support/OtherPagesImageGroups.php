<?php

namespace App\Support;

class OtherPagesImageGroups
{
    public const PAGES = [
        'about' => [
            'label' => 'Về CLB',
            'groups' => [
                'Banner trang' => [
                    'about_banner' => 'Ảnh banner trang Về CLB (ngang, tràn viền)',
                ],
                'Đôi lời tâm sự' => [
                    'about_letter_photo' => 'Ảnh chân dung người chia sẻ',
                ],
                'CTA cuối trang' => [
                    'about_closing_cta_photo' => 'Ảnh nền full-bleed cho khối CTA cuối trang (tùy chọn)',
                ],
            ],
        ],

        'method' => [
            'label' => 'Phương pháp',
            'groups' => [
                'Banner trang' => [
                    'method_banner' => 'Ảnh banner trang Phương pháp',
                ],
                'Phương pháp huấn luyện C.A.R.E' => [
                    'method_care_celebrate' => 'Ảnh minh họa Celebrate',
                    'method_care_ask_answer' => 'Ảnh minh họa Ask & Answer',
                    'method_care_repetition' => 'Ảnh minh họa Repetition',
                    'method_care_enjoy_strict' => 'Ảnh minh họa Enjoy & Strict',
                ],
                'Banner "Giáo dục bằng trái tim"' => [
                    'method_heart_banner' => 'Ảnh banner cuối trang',
                ],
                'CTA cuối trang' => [
                    'method_closing_cta_photo' => 'Ảnh nền full-bleed cho khối CTA cuối trang (tùy chọn)',
                ],
            ],
        ],

        'program' => [
            'label' => 'Chương trình dạy',
            'groups' => [
                'Banner trang' => [
                    'program_banner' => 'Ảnh banner trang Chương trình dạy',
                ],
                'Cấu trúc mỗi buổi học' => [
                    'program_structure_warmup' => 'Ảnh Khởi động (10 phút)',
                    'program_structure_technique' => 'Ảnh Kỹ thuật & Chủ đề tháng (45 phút)',
                    'program_structure_match' => 'Ảnh Thi đấu ứng dụng (30 phút)',
                    'program_structure_review' => 'Ảnh Đánh giá - Ghi nhớ - Tổng kết (5 phút)',
                ],
                'Chương trình theo độ tuổi' => [
                    'program_age_toddler' => 'Ảnh Mầm non (3-6 tuổi)',
                    'program_age_primary' => 'Ảnh Tiểu học (7-10 tuổi)',
                    'program_age_teen' => 'Ảnh Thiếu niên (11-14 tuổi)',
                ],
            ],
        ],

        'activity' => [
            'label' => 'Hoạt động & Sự kiện',
            'groups' => [
                'Banner trang' => [
                    'activity_banner' => 'Ảnh banner trang Hoạt động & Sự kiện',
                ],
            ],
        ],

        'branch' => [
            'label' => 'Hệ thống cơ sở',
            'groups' => [
                'Banner trang' => [
                    'branch_banner' => 'Ảnh banner trang Hệ thống cơ sở',
                ],
            ],
        ],

        'parent' => [
            'label' => 'Dành cho phụ huynh',
            'groups' => [
                'Banner trang' => [
                    'parent_banner' => 'Ảnh banner trang Dành cho phụ huynh',
                ],
            ],
        ],

        'registration' => [
            'label' => 'Liên hệ & Đăng ký học thử',
            'groups' => [
                'Banner trang' => [
                    'registration_banner' => 'Ảnh banner trang Liên hệ & Đăng ký học thử',
                ],
            ],
        ],
    ];
}