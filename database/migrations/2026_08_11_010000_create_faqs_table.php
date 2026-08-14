<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('show_on_home')->default(false);
            $table->timestamps();
        });

        $now = now();

        DB::table('faqs')->insert([
            [
                'question' => 'Alpha Kids nhận học viên từ mấy tuổi?',
                'answer' => 'Alpha Kids Football Club nhận học viên từ 3 tuổi trở lên. Chương trình được thiết kế riêng theo 3 nhóm tuổi: Mầm non, Tiểu học và Thiếu niên, cùng áp dụng chung một phương pháp giáo dục.',
                'sort_order' => 1,
                'is_active' => true,
                'show_on_home' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question' => 'Có được học thử trước khi đăng ký chính thức không?',
                'answer' => 'Có. Phụ huynh có thể đăng ký một buổi học thử miễn phí tại cơ sở gần nhất để con trải nghiệm trước khi quyết định đăng ký chính thức.',
                'sort_order' => 2,
                'is_active' => true,
                'show_on_home' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question' => 'Phương pháp huấn luyện C.A.R.E là gì?',
                'answer' => 'C.A.R.E là phương pháp huấn luyện xuyên suốt tại Alpha Kids, giúp trẻ phát triển 4 tư duy cốt lõi: giao tiếp, đánh giá, ứng xử và lãnh đạo, thông qua các hoạt động và tình huống bóng đá thực tế trong mỗi buổi tập.',
                'sort_order' => 3,
                'is_active' => true,
                'show_on_home' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question' => 'Alpha Kids có bao nhiêu cơ sở? Tôi nên đăng ký ở đâu?',
                'answer' => 'Alpha Kids hiện có nhiều cơ sở đang hoạt động. Khi đăng ký học thử, phụ huynh chọn cơ sở gần nhất hoặc phù hợp nhất với lịch sinh hoạt của gia đình, đội ngũ sẽ liên hệ xác nhận lịch cụ thể.',
                'sort_order' => 4,
                'is_active' => true,
                'show_on_home' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question' => 'Sau khi đăng ký học thử, bao lâu thì được liên hệ lại?',
                'answer' => 'Sau khi gửi thông tin đăng ký, đội ngũ Alpha Kids sẽ liên hệ với phụ huynh trong thời gian sớm nhất để xác nhận lịch học thử cụ thể tại cơ sở đã chọn.',
                'sort_order' => 5,
                'is_active' => true,
                'show_on_home' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
