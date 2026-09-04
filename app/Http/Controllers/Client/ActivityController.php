<?php

namespace App\Http\Controllers\Client;

use App\Enums\ActivityCategory;
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

        $pillarCategories = [
            ActivityCategory::TOURNAMENT,
            ActivityCategory::MEETUP,
            ActivityCategory::FAMILY_DAY,
        ];

        $pillars = collect($pillarCategories)->map(function (ActivityCategory $category) use ($activities) {
            $items = $activities->where('category', $category);

            return [
                'category' => $category,
                'highlight' => $items->first(),
                'count' => $items->count(),
            ];
        });

        $ogImage = $images['activity_banner']
            ?? $activities->first(fn (Activity $activity) => $activity->image)?->image;
        $ogImage = $ogImage ? asset('storage/' . $ogImage) : null;

        return view('client.activity.index', compact('images', 'activities', 'pillars', 'ogImage'));
    }
}
