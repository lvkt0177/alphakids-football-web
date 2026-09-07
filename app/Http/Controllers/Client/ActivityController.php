<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Setting;

class ActivityController extends Controller
{
    public function index()
    {
        $images = [
            'activity_banner' => Setting::get('activity_banner'),
            'activity_closing_cta_photo' => Setting::get('activity_closing_cta_photo'),
        ];

        $activities = Activity::active()->ordered()->get();

        $ogImage = $images['activity_banner']
            ?? $activities->first(fn (Activity $activity) => $activity->image)?->image;
        $ogImage = $ogImage ? asset('storage/' . $ogImage) : null;

        return view('client.activity.index', compact('images', 'activities', 'ogImage'));
    }

    public function show(Activity $activity)
    {
        abort_unless($activity->is_active, 404);

        $activity->load('images');

        $ogImage = $activity->image ?? optional($activity->images->first())->image;
        $ogImage = $ogImage ? asset('storage/' . $ogImage) : null;

        $closingCtaPhoto = Setting::get('activity_closing_cta_photo');

        return view('client.activity.show', compact('activity', 'ogImage', 'closingCtaPhoto'));
    }
}
