<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\AboutLetterSettingRequest;
use App\Http\Requests\Admin\Setting\FeaturedActivityRequest;
use App\Http\Requests\Admin\Setting\GeneralSettingRequest;
use App\Http\Requests\Admin\Setting\ImageSettingRequest;
use App\Http\Requests\Admin\Setting\VideoSettingRequest;
use App\Models\Activity;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use App\Support\OtherPagesImageGroups;
use Intervention\Image\ImageManager;

class SettingController extends Controller
{
    public const IMAGE_GROUPS = [
        'Banner chính' => [
            'home_banner' => 'Ảnh banner chính (Desktop)',
            'home_banner_mobile_source' => 'Ảnh banner riêng cho Mobile (tùy chọn)',
        ],
        'Giới thiệu CLB' => [
            'home_club_intro' => 'Ảnh đội hình / giới thiệu CLB',
        ],
        '4 tư duy cốt lõi' => [
            'home_pillar_photo' => 'Ảnh minh họa Tư duy 01 - Giao tiếp',
            'home_pillar_photo_2' => 'Ảnh minh họa Tư duy 02 - Đánh giá (tùy chọn)',
            'home_pillar_photo_3' => 'Ảnh minh họa Tư duy 03 - Ứng xử (tùy chọn)',
            'home_pillar_photo_4' => 'Ảnh minh họa Tư duy 04 - Lãnh đạo (tùy chọn)',
        ],
        'Phương pháp huấn luyện C.A.R.E' => [
            'home_care_photo_1' => 'Ảnh minh họa 1',
            'home_care_photo_2' => 'Ảnh minh họa 2 (tùy chọn)',
        ],
        'Các lớp học tại Alpha Kids' => [
            'home_class_toddler' => 'Ảnh lớp Mầm non (3-6 tuổi)',
            'home_class_primary' => 'Ảnh lớp Tiểu học (7-10 tuổi)',
            'home_class_teen' => 'Ảnh lớp Cấp 2 (11-14 tuổi)',
        ],
        'CTA đăng ký học thử (cuối trang)' => [
            'home_closing_cta_photo' => 'Ảnh nền full-bleed cho khối CTA cuối trang (tùy chọn)',
        ],
    ];

    public function home()
    {
        $images = [];
        foreach (self::IMAGE_GROUPS as $keys) {
            foreach (array_keys($keys) as $key) {
                $images[$key] = Setting::get($key);
            }
        }

        $videoMode = Setting::get('video_mode', 'youtube');
        $youtubeUrl = Setting::get('video_youtube_url');
        $videoFile = Setting::get('video_file');
        $videoThumbnail = Setting::get('home_video_thumbnail');

        $activities = Activity::active()->orderBy('name')->get();

        $heroCropDesktop = json_decode(Setting::get('home_banner_crop_desktop', ''), true);
        $heroCropMobile = json_decode(Setting::get('home_banner_crop_mobile', ''), true);

        return view('admin.setting.home', compact('images', 'videoMode', 'youtubeUrl', 'videoFile', 'videoThumbnail', 'activities', 'heroCropDesktop', 'heroCropMobile'));
    }

    public function updateImages(ImageSettingRequest $request)
    {
        $files = $request->file('images', []);
        // Mobile falls back to cropping the desktop photo when it has no
        // dedicated source of its own - capture that BEFORE any new upload
        // in this request overwrites it, so we know whether the fallback
        // photo is about to change out from under the mobile crop too.
        $mobileHadOwnSourceBefore = (bool) Setting::get('home_banner_mobile_source');

        foreach ($files as $key => $file) {
            if (! $file || ! $file->isValid()) {
                continue;
            }

            $old = Setting::get($key);
            if ($old) {
                Storage::disk('public')->delete($old);
            }

            $path = $file->store('settings', 'public');
            Setting::set($key, $path);

            if ($key === 'home_banner') {
                $this->clearHeroCropVariant('desktop');
                if (! $mobileHadOwnSourceBefore) {
                    // Mobile was relying on this same photo - its crop
                    // coordinates belonged to the old desktop photo.
                    $this->clearHeroCropVariant('mobile');
                }
            } elseif ($key === 'home_banner_mobile_source') {
                $this->clearHeroCropVariant('mobile');
            }
        }

        if ($request->filled('crop_desktop') || $request->filled('crop_mobile')) {
            $this->processHeroCrop($request);
        }

        return back()->with('success', 'Đã lưu ảnh.');
    }

    /**
     * Generate the desktop/mobile pre-cropped derivatives of the homepage
     * hero banner from the crop-box coordinates picked in Admin. Trang chủ
     * hero only. Desktop always crops `home_banner`; mobile crops its own
     * `home_banner_mobile_source` when Admin has uploaded one, falling back
     * to the same `home_banner` photo otherwise.
     */
    protected function processHeroCrop(ImageSettingRequest $request): void
    {
        $manager = ImageManager::gd();

        $sources = [
            'desktop' => Setting::get('home_banner'),
            'mobile' => Setting::get('home_banner_mobile_source') ?: Setting::get('home_banner'),
        ];

        foreach (['desktop' => 'crop_desktop', 'mobile' => 'crop_mobile'] as $variant => $field) {
            $crop = $request->input($field);
            if (! is_array($crop) || ! isset($crop['x'], $crop['y'], $crop['width'], $crop['height'])) {
                continue;
            }

            $sourcePath = $sources[$variant];
            if (! $sourcePath || ! Storage::disk('public')->exists($sourcePath)) {
                continue;
            }

            $image = $manager->read(Storage::disk('public')->path($sourcePath));
            $image->crop(
                (int) round($crop['width']),
                (int) round($crop['height']),
                (int) round($crop['x']),
                (int) round($crop['y'])
            );

            $key = "home_banner_{$variant}";
            $old = Setting::get($key);
            if ($old) {
                Storage::disk('public')->delete($old);
            }

            $filename = 'settings/'.uniqid("home_banner_{$variant}_").'.jpg';
            Storage::disk('public')->put($filename, (string) $image->toJpeg(85));

            Setting::set($key, $filename);
            Setting::set("home_banner_crop_{$variant}", json_encode($crop));
        }
    }

    /**
     * A freshly uploaded source photo invalidates the matching derivative's
     * crop (its coordinates belonged to the old photo) - clear it so the
     * client falls back to the new original until Admin re-crops it.
     */
    protected function clearHeroCropVariant(string $variant): void
    {
        $key = "home_banner_{$variant}";
        $old = Setting::get($key);
        if ($old) {
            Storage::disk('public')->delete($old);
        }
        Setting::set($key, null);
        Setting::set("home_banner_crop_{$variant}", null);
    }

    public function updateVideo(VideoSettingRequest $request)
    {
        $data = $request->validated();

        Setting::set('video_mode', $data['video_mode']);

        if ($data['video_mode'] === 'youtube') {
            Setting::set('video_youtube_url', $data['video_youtube_url'] ?? null);
        } elseif ($request->hasFile('video_file')) {
            $old = Setting::get('video_file');
            if ($old) {
                Storage::disk('public')->delete($old);
            }
            $path = $request->file('video_file')->store('settings/video', 'public');
            Setting::set('video_file', $path);
        }

        if ($request->hasFile('video_thumbnail')) {
            $oldThumbnail = Setting::get('home_video_thumbnail');
            if ($oldThumbnail) {
                Storage::disk('public')->delete($oldThumbnail);
            }
            $thumbnailPath = $request->file('video_thumbnail')->store('settings/video', 'public');
            Setting::set('home_video_thumbnail', $thumbnailPath);
        }

        return redirect()->route('admin.setting.home')->with('success', 'Đã lưu video.');
    }

    public function updateFeaturedActivities(FeaturedActivityRequest $request)
    {
        $selected = $request->validated()['activities'] ?? [];

        Activity::query()->update(['is_featured' => false, 'featured_order' => null]);

        foreach (array_values($selected) as $index => $activityId) {
            Activity::where('id', $activityId)->update([
                'is_featured' => true,
                'featured_order' => $index + 1,
            ]);
        }

        return redirect()->route('admin.setting.home')->with('success', 'Đã lưu hoạt động nổi bật.');
    }

    public function otherPages()
    {
        $images = [];
        foreach (OtherPagesImageGroups::PAGES as $page) {
            foreach ($page['groups'] as $keys) {
                foreach (array_keys($keys) as $key) {
                    $images[$key] = Setting::get($key);
                }
            }
        }

        $aboutLetter = [
            'about_letter_name' => Setting::get('about_letter_name'),
            'about_letter_role' => Setting::get('about_letter_role'),
            'about_letter_message' => Setting::get('about_letter_message'),
        ];

        return view('admin.setting.other-pages', compact('images', 'aboutLetter'));
    }

    public function updateAboutLetter(AboutLetterSettingRequest $request)
    {
        foreach ($request->validated() as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.setting.other-pages')->with('success', 'Đã lưu lời tâm sự.');
    }

    public function general()
    {
        $fields = [
            'hotline' => Setting::get('hotline'),
            'zalo_contact' => Setting::get('zalo_contact'),
            'email' => Setting::get('email'),
            'address' => Setting::get('address'),
            'consulting_hours' => Setting::get('consulting_hours'),
            'facebook_url' => Setting::get('facebook_url'),
            'tiktok_url' => Setting::get('tiktok_url'),
            'zalo_url' => Setting::get('zalo_url'),
        ];

        return view('admin.setting.general', compact('fields'));
    }

    public function updateGeneral(GeneralSettingRequest $request)
    {
        foreach ($request->validated() as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.setting.general')->with('success', 'Đã lưu thông tin chung.');
    }
}
