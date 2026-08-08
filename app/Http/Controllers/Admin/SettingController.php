<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\FeaturedActivityRequest;
use App\Http\Requests\Admin\Setting\GeneralSettingRequest;
use App\Http\Requests\Admin\Setting\ImageSettingRequest;
use App\Http\Requests\Admin\Setting\VideoSettingRequest;
use App\Models\Activity;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public const IMAGE_GROUPS = [
        'Banner chính' => [
            'home_banner' => 'Ảnh banner chính',
        ],
        'Giới thiệu CLB' => [
            'home_club_intro' => 'Ảnh đội hình / giới thiệu CLB',
        ],
        'Các lớp học tại Alpha Kids' => [
            'home_class_toddler' => 'Ảnh lớp Mầm non (3-6 tuổi)',
            'home_class_primary' => 'Ảnh lớp Tiểu học (7-10 tuổi)',
            'home_class_teen' => 'Ảnh lớp Thiếu niên (11-14 tuổi)',
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

        $activities = Activity::active()->orderBy('name')->get();

        return view('admin.setting.home', compact('images', 'videoMode', 'youtubeUrl', 'videoFile', 'activities'));
    }

    public function updateImages(ImageSettingRequest $request)
    {
        $files = $request->file('images', []);

        foreach ($files as $key => $file) {
            if (! $file) {
                continue;
            }

            $old = Setting::get($key);
            if ($old) {
                Storage::disk('public')->delete($old);
            }

            $path = $file->store('settings', 'public');
            Setting::set($key, $path);
        }

        return redirect()->route('admin.setting.home')->with('success', 'Đã lưu ảnh.');
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
