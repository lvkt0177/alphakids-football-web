<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HeroCropTest extends TestCase
{
    use RefreshDatabase;

    public function test_hero_crop_saves_and_restores_through_real_http_cycle(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['username' => 'debug_tester']);

        // Seed an existing home_banner like a prior upload would have left.
        $original = UploadedFile::fake()->image('banner.jpg', 1600, 900);
        $storedPath = $original->store('settings', 'public');
        Setting::set('home_banner', $storedPath);

        $this->actingAs($user);

        $cropDesktop = ['x' => 12, 'y' => 34, 'width' => 800, 'height' => 343];
        $cropMobile = ['x' => 100, 'y' => 0, 'width' => 500, 'height' => 625];

        $response = $this->post(route('admin.setting.home.images.update'), [
            'images' => [],
            'crop_desktop' => $cropDesktop,
            'crop_mobile' => $cropMobile,
        ]);

        $response->assertRedirect();

        $this->assertNotNull(Setting::get('home_banner_desktop'), 'home_banner_desktop was never saved');
        $this->assertNotNull(Setting::get('home_banner_mobile'), 'home_banner_mobile was never saved');
        $this->assertSame($cropDesktop, json_decode(Setting::get('home_banner_crop_desktop'), true));
        $this->assertSame($cropMobile, json_decode(Setting::get('home_banner_crop_mobile'), true));

        // GET the settings page again and confirm the hidden restore inputs
        // actually carry the previously saved crop data in the rendered HTML,
        // so Admin re-opening the page sees the crop box where they left it.
        $page = $this->get(route('admin.setting.home'));
        $page->assertOk();

        preg_match('/id="heroCropDesktopInitial" value="([^"]*)"/', $page->getContent(), $m);
        $this->assertNotEmpty($m[1] ?? '', 'heroCropDesktopInitial hidden input is empty in the rendered page');
        $this->assertSame($cropDesktop, json_decode(html_entity_decode($m[1]), true));

        preg_match('/id="heroCropMobileInitial" value="([^"]*)"/', $page->getContent(), $m);
        $this->assertNotEmpty($m[1] ?? '', 'heroCropMobileInitial hidden input is empty in the rendered page');
        $this->assertSame($cropMobile, json_decode(html_entity_decode($m[1]), true));
    }

    public function test_uploading_a_new_banner_clears_stale_crop_derivatives(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['username' => 'debug_tester_2']);
        $this->actingAs($user);

        $original = UploadedFile::fake()->image('banner.jpg', 1600, 900);
        Setting::set('home_banner', $original->store('settings', 'public'));
        Setting::set('home_banner_desktop', 'settings/old_desktop.jpg');
        Setting::set('home_banner_mobile', 'settings/old_mobile.jpg');
        Setting::set('home_banner_crop_desktop', json_encode(['x' => 1, 'y' => 2, 'width' => 3, 'height' => 4]));
        Setting::set('home_banner_crop_mobile', json_encode(['x' => 1, 'y' => 2, 'width' => 3, 'height' => 4]));

        $this->post(route('admin.setting.home.images.update'), [
            'images' => ['home_banner' => UploadedFile::fake()->image('new-banner.jpg', 1600, 900)],
        ])->assertRedirect();

        $this->assertNull(Setting::get('home_banner_desktop'));
        $this->assertNull(Setting::get('home_banner_mobile'));
        $this->assertNull(Setting::get('home_banner_crop_desktop'));
        $this->assertNull(Setting::get('home_banner_crop_mobile'));
    }

    public function test_mobile_crop_reads_its_own_uploaded_source_when_present(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['username' => 'debug_tester_3']);
        $this->actingAs($user);

        // Two distinctly-sized source photos so a wrong-file read is
        // detectable: desktop crop request only fits the desktop photo,
        // mobile crop request only fits the mobile-specific photo.
        $desktopSource = UploadedFile::fake()->image('desktop.jpg', 2000, 800);
        $mobileSource = UploadedFile::fake()->image('mobile.jpg', 600, 1400);
        Setting::set('home_banner', $desktopSource->store('settings', 'public'));
        Setting::set('home_banner_mobile_source', $mobileSource->store('settings', 'public'));

        $cropDesktop = ['x' => 0, 'y' => 0, 'width' => 1800, 'height' => 700]; // fits desktop (2000x800), not mobile (600x1400)
        $cropMobile = ['x' => 0, 'y' => 0, 'width' => 500, 'height' => 1200]; // fits mobile (600x1400), not desktop (2000x800)

        $this->post(route('admin.setting.home.images.update'), [
            'images' => [],
            'crop_desktop' => $cropDesktop,
            'crop_mobile' => $cropMobile,
        ])->assertRedirect();

        $manager = \Intervention\Image\ImageManager::gd();

        $desktopDerivative = $manager->read(Storage::disk('public')->path(Setting::get('home_banner_desktop')));
        $this->assertSame(1800, $desktopDerivative->width());
        $this->assertSame(700, $desktopDerivative->height());

        $mobileDerivative = $manager->read(Storage::disk('public')->path(Setting::get('home_banner_mobile')));
        $this->assertSame(500, $mobileDerivative->width());
        $this->assertSame(1200, $mobileDerivative->height());
    }

    public function test_new_desktop_photo_does_not_disturb_mobile_when_mobile_has_its_own_source(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['username' => 'debug_tester_4']);
        $this->actingAs($user);

        Setting::set('home_banner', UploadedFile::fake()->image('banner.jpg', 1600, 900)->store('settings', 'public'));
        Setting::set('home_banner_mobile_source', UploadedFile::fake()->image('mobile.jpg', 600, 1400)->store('settings', 'public'));
        Setting::set('home_banner_mobile', 'settings/existing_mobile_derivative.jpg');
        Setting::set('home_banner_crop_mobile', json_encode(['x' => 1, 'y' => 2, 'width' => 3, 'height' => 4]));

        $this->post(route('admin.setting.home.images.update'), [
            'images' => ['home_banner' => UploadedFile::fake()->image('new-banner.jpg', 1600, 900)],
        ])->assertRedirect();

        // Mobile has its own source photo - a new desktop photo must not touch it.
        $this->assertSame('settings/existing_mobile_derivative.jpg', Setting::get('home_banner_mobile'));
        $this->assertSame(
            ['x' => 1, 'y' => 2, 'width' => 3, 'height' => 4],
            json_decode(Setting::get('home_banner_crop_mobile'), true)
        );
    }

    public function test_new_desktop_photo_clears_mobile_when_mobile_has_no_own_source(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['username' => 'debug_tester_5']);
        $this->actingAs($user);

        Setting::set('home_banner', UploadedFile::fake()->image('banner.jpg', 1600, 900)->store('settings', 'public'));
        Setting::set('home_banner_mobile', 'settings/old_fallback_derivative.jpg');
        Setting::set('home_banner_crop_mobile', json_encode(['x' => 1, 'y' => 2, 'width' => 3, 'height' => 4]));

        $this->post(route('admin.setting.home.images.update'), [
            'images' => ['home_banner' => UploadedFile::fake()->image('new-banner.jpg', 1600, 900)],
        ])->assertRedirect();

        // Mobile was following the desktop photo - its stale crop must clear too.
        $this->assertNull(Setting::get('home_banner_mobile'));
        $this->assertNull(Setting::get('home_banner_crop_mobile'));
    }

    public function test_uploading_mobile_source_only_clears_mobile_not_desktop(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['username' => 'debug_tester_6']);
        $this->actingAs($user);

        Setting::set('home_banner', UploadedFile::fake()->image('banner.jpg', 1600, 900)->store('settings', 'public'));
        Setting::set('home_banner_desktop', 'settings/existing_desktop_derivative.jpg');
        Setting::set('home_banner_crop_desktop', json_encode(['x' => 5, 'y' => 6, 'width' => 7, 'height' => 8]));
        Setting::set('home_banner_mobile', 'settings/old_mobile_derivative.jpg');
        Setting::set('home_banner_crop_mobile', json_encode(['x' => 1, 'y' => 2, 'width' => 3, 'height' => 4]));

        $this->post(route('admin.setting.home.images.update'), [
            'images' => ['home_banner_mobile_source' => UploadedFile::fake()->image('mobile.jpg', 600, 1400)],
        ])->assertRedirect();

        $this->assertNull(Setting::get('home_banner_mobile'));
        $this->assertNull(Setting::get('home_banner_crop_mobile'));

        // Desktop's own crop is unrelated to the mobile-source upload.
        $this->assertSame('settings/existing_desktop_derivative.jpg', Setting::get('home_banner_desktop'));
        $this->assertSame(
            ['x' => 5, 'y' => 6, 'width' => 7, 'height' => 8],
            json_decode(Setting::get('home_banner_crop_desktop'), true)
        );
    }
}
