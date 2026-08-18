<?php

namespace App\View\Composers;

use App\Models\Setting;
use Illuminate\View\View;

class SiteSettingsComposer
{
    protected const KEYS = [
        'hotline',
        'zalo_contact',
        'email',
        'address',
        'consulting_hours',
        'facebook_url',
        'tiktok_url',
        'zalo_url',
    ];

    public function compose(View $view): void
    {
        $view->with(
            'siteSettings',
            Setting::query()->whereIn('key', self::KEYS)->pluck('value', 'key')
        );
    }
}
